<?php
require_once 'DBConnect.php';
require_once 'ContactManager.php';
require_once 'Command.php';

$dbConnection   = new DBConnect();
$pdo            = $dbConnection->getPDO();
$contactManager = new ContactManager($pdo);
$commandHandler = new Command($contactManager);

while (true) {
    $line = readline("Entrez votre commande (list , quit, detail, create, modify, delete, help) :" . PHP_EOL);
    echo "Vous avez saisi : $line" . PHP_EOL;

    if ($line === "quit") {
        echo "Au revoir !" . PHP_EOL;
        break; // pour sortir de la boucle while(1)
    }

    if ($line === "list") {
        $commandHandler->list();

    } elseif (preg_match('/^detail (\d+)$/', $line, $matches)) {
        $id = (int) $matches[1];
        $commandHandler->detail($id);

    } elseif (preg_match('/^create ([^,]+),\s*([^,]+),\s*([^,]+)$/', $line, $matches)) {
        // $matches[1] = nom, $matches[2] = email, $matches[3] = tel
        $commandHandler->create($matches[1], $matches[2], $matches[3]);

    } elseif (preg_match('/^delete (\d+)$/', $line, $matches)) {
        $commandHandler->delete((int) $matches[1]);

    } elseif (preg_match('/^modify (\d+), ([^,]+), ([^,]+), ([^,]+)$/', $line, $matches)) {
        $commandHandler->modify(
            (int) $matches[1], // Id
            $matches[2],       // Nom
            $matches[3],       // Email
            $matches[4]        // Tel
        );

    } elseif ($line === 'help') {
        $commandHandler->help();

    } else {
        echo "Commande inconnue." . PHP_EOL;
    }
}
