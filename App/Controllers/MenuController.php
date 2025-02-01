<?php

namespace App\Controllers;

class MenuController
{
    private function menuOptions(): void
    {
        echo "\n\n\n";
        echo "------------------- W E L C O M E -------------------\n";
        echo "1. Printing Key-Value Pairs\n";
        echo "2. Sorting Data\n";
        echo "3. Shopping Cart\n";
        echo "4. Exit\n";
    }

    public function run(): void
    {
        do {
            $this->menuOptions();
            $option = readline("Type option: ");

            switch ($option) {
                case '1':
                    echo "\n********* P R I N T I N G *********\n";
                    break;
                case '2':
                    echo "\n********* S O R T I N G *********\n";
                    break;
                case '3':
                    echo "\n********* S H O P P I N G *********\n";
                    break;
                case '4':
                    echo "\n********* C H A O *********\n";
                    echo "Exiting...\n";
                    break;
                default:
                    echo "\n********* ¡¡ W O O P S !! *********\n";
                    echo "Invalid option, please try again.\n";
            }

        } while ($option !== '4');
    }
}
