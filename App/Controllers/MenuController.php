<?php

namespace App\Controllers;

use App\Infrastructure\ServiceContainer;
use App\Services\JsonFileLoaderService;
use App\Services\KeyValueFormatterService;

class MenuController
{

    public function __construct(


    /**
     * @param ServiceContainer $container
     */
    public function __construct(
        private ServiceContainer $container,
    ) {
    }

    /**
     * @return string[]
     */
    private function getMenuOptions(): array
    {
        return [
            '1' => 'Printing Key-Value Pairs',
            '2' => 'Sorting Data',
            '3' => 'Shopping Cart',
            '4' => 'Exit',
        ];
    }

    /**
     * @return void
     */
    private function displayMenu(): void
    {
        echo "\n\n\n------------------- W E L C O M E -------------------\n";
        foreach ($this->getMenuOptions() as $key => $label) {
            echo "$key. $label\n";
        }
    }

    /**
     * @return string
     */
    private function getOptionFromInput(): string
    {
        return trim(readline("Type option: "));
    }

    /**
     * @param string $section
     * @return void
     */
    private function printSectionHeader(string $section): void
    {
        $formattedSection = str_replace(' ', '   ', $section);
        echo "\n********* " . strtoupper($formattedSection) . " *********\n";
    }

    /**
     * @return string[]
     */
    private function getCommandHandlers(): array
    {
        return [
            '1' => 'handlePrinting',
            '2' => 'handleSorting',
            '3' => 'handleShoppingCart',
            '4' => 'handleExit',
        ];
    }

    /**
     * @return void
     */
    private function handlePrinting(): void
    {
        $this->printSectionHeader('Printing');
        $loader = $this->container->get(JsonFileLoaderService::class);
        $formatter = $this->container->get(KeyValueFormatterService::class);
        echo $formatter->format($loader->getData());
    }

    /**
     * @return void
     */
    private function handleSorting(): void
    {
        $this->printSectionHeader('Sorting');
    }

    /**
     * @return void
     */
    private function handleShoppingCart(): void
    {
        $this->printSectionHeader('Shopping');
    }

    /**
     * @return void
     */
    private function handleExit(): void
    {
        $this->printSectionHeader('CHAO');
        echo "Exiting...\n";
    }

    /**
     * @return void
     */
    private function handleInvalidOption(): void
    {
        $this->printSectionHeader('¡¡ W O O P S !!');
        echo "Invalid option, please try again.\n";
    }

    /**
     * @return void
     */
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
