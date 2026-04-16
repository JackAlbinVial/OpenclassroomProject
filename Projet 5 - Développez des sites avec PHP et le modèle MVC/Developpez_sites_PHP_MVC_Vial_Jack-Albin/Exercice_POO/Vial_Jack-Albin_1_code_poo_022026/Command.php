<?php
require_once 'ContactManager.php';

class Command
{
    private ContactManager $contactManager;

    public function __construct(ContactManager $contactManager)
    {
        $this->contactManager = $contactManager;
    }

    public function list(): void
    {
        $contacts = $this->contactManager->findAll();

        if (empty($contacts)) {
            echo "Aucun contact trouvé." . PHP_EOL;
            return;
        }

        foreach ($contacts as $contact) {
            echo $contact . PHP_EOL;
        }
    }

    public function detail(int $id): void
    {
        $contact = $this->contactManager->findById($id);

        if ($contact === null) {
            echo "Erreur : Aucun contact trouvé avec l'ID $id." . PHP_EOL;
        } else {
            echo "--- Détail du contact ---" . PHP_EOL;
            echo $contact . PHP_EOL;
        }
    }

    public function delete(int $id): void
    {
        $success = $this->contactManager->delete($id);
        if ($success) {
            echo "Contact $id supprimé avec succès." . PHP_EOL;
        } else {
            echo "Erreur lors de la suppression." . PHP_EOL;
        }
    }

    public function create(string $name, string $email, string $phone): void
    {
        // Ocréation d'un objet Contact ID est null car géré par la BDD
        $contact = new Contact(null, $name, $email, $phone);

        $this->contactManager->create($contact);
        echo "Nouveau contact créé !" . PHP_EOL;
    }

    public function help(): void
    {
        echo "--- Liste des commandes disponibles ---" . PHP_EOL;
        echo "list               : Affiche tous les contacts" . PHP_EOL;
        echo "detail [id]        : Affiche les détails d'un contact (ex: detail 1)" . PHP_EOL;
        echo "create [nom], [email], [tel] : Crée un nouveau contact" . PHP_EOL;
        echo "modify [id], [nom], [email], [tel] : Modifie un contact existant" . PHP_EOL;
        echo "delete [id]        : Supprime un contact" . PHP_EOL;
        echo "help               : Affiche cet aide" . PHP_EOL;
        echo "quit               : Quitte le programme" . PHP_EOL;
        echo "---------------------------------------" . PHP_EOL;
    }

    public function modify(int $id, string $name, string $email, string $phone): void
    {
        // On vérifie si le contact existe
        $contact = $this->contactManager->findById($id);

        if (! $contact) {
            echo "Erreur : Impossible de modifier, le contact $id n'existe pas." . PHP_EOL;
            return;
        }

        // On met à jour l'objet avec les nouvelles valeurs
        $contact->setName($name);
        $contact->setEmail($email);
        $contact->setPhoneNumber($phone);

        // On demande au manager de sauvegarder en base
        if ($this->contactManager->update($contact)) {
            echo "Contact $id mis à jour avec succès !" . PHP_EOL;
        }
    }
}
