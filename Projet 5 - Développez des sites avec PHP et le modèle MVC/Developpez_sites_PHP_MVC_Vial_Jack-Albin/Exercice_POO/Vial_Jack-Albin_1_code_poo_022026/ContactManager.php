<?php
require_once 'Contact.php';

class ContactManager
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $sql       = "SELECT id, name, email, phone_number FROM contact";
        $statement = $this->pdo->query($sql);

        // On récupère tous les résultats
        $rows = $statement->fetchAll();

        $contacts = [];

        foreach ($rows as $row) {

            $contact = new Contact(
                $row['id'],
                $row['name'],
                $row['email'],
                $row['phone_number']
            );
            $contacts[] = $contact;
        }
        return $contacts;
    }

    public function findById(int $id): ?Contact
    {
        $sql       = "SELECT id, name, email, phone_number FROM contact WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id]);

        $row = $statement->fetch();

        if (! $row) {
            return null;
        }

        // retour d'un objet contact formée des éléments trouvé
        return new Contact(
            $row['id'],
            $row['name'],
            $row['email'],
            $row['phone_number']
        );
    }

    public function delete(int $id): bool
    {
        $sql       = "DELETE FROM contact WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        return $statement->execute(['id' => $id]);
    }

    public function create(Contact $contact): void
    {
        $sql = "INSERT INTO contact (name, email, phone_number)
            VALUES (:name, :email, :phone)";

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name'  => $contact->getName(),
            'email' => $contact->getEmail(),
            'phone' => $contact->getPhoneNumber(),
        ]);
    }

    public function update(Contact $contact): bool
    {
        $sql = "UPDATE contact
            SET name = :name, email = :email, phone_number = :phone
            WHERE id = :id";

        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            'id'    => $contact->getId(),
            'name'  => $contact->getName(),
            'email' => $contact->getEmail(),
            'phone' => $contact->getPhoneNumber(),
        ]);
    }

}
