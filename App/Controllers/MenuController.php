<?php

namespace App\Controllers;

class MenuController
{
    private function getMenuOptions(): array
    {
        return [
            '1' => 'Printing Key-Value Pairs',
            '2' => 'Sorting Data',
            '3' => 'Shopping Cart',
            '4' => 'Exit',
        ];
    }

    private function displayMenu(): void
    {
        echo "\n\n\n------------------- W E L C O M E -------------------\n";
        foreach ($this->getMenuOptions() as $key => $label) {
            echo "$key. $label\n";
        }
    }

    private function getOptionFromInput(): string
    {
        return trim(readline("Type option: "));
    }

    private function printSectionHeader(string $section): void
    {
        $formattedSection = str_replace(' ', '   ', $section);
        echo "\n********* " . strtoupper($formattedSection) . " *********\n";
    }

    private function getCommandHandlers(): array
    {
        return [
            '1' => 'handlePrinting',
            '2' => 'handleSorting',
            '3' => 'handleShoppingCart',
            '4' => 'handleExit',
        ];
    }

    private function handlePrinting(): void
    {
        $this->printSectionHeader('Printing');
    }

    private function handleSorting(): void
    {
        $this->printSectionHeader('Sorting');
    }

    private function handleShoppingCart(): void
    {
        $this->printSectionHeader('Shopping');
    }

    private function handleExit(): void
    {
        $this->printSectionHeader('CHAO');
        echo "Exiting...\n";
    }

    private function handleInvalidOption(): void
    {
        $this->printSectionHeader('¡¡ W O O P S !!');
        echo "Invalid option, please try again.\n";
    }

    public function run(): void
    {
        do {
            $this->displayMenu();
            $option = $this->getOptionFromInput();
            $handlers = $this->getCommandHandlers();

            if (isset($handlers[$option])) {
                $this->{$handlers[$option]}();
            } else {
                $this->handleInvalidOption();
            }
        } while ($option !== '4');
    }
}