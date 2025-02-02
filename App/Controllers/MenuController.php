<?php

namespace App\Controllers;

use App\Infrastructure\ServiceContainer;
use App\Services\CartService;
use App\Services\JsonFileLoaderService;
use App\Services\KeyValueFormatterService;
use App\Services\SortService;

class MenuController
{
    /**
     * @var \Closure[]
     */
    private array $menuHandlers;

    /**
     * @param ServiceContainer $container
     */
    public function __construct(
        private ServiceContainer $container,
    ) {
        $this->menuHandlers = [
            '1' => fn () => $this->handlePrinting(),
            '2' => fn () => $this->handleSorting(),
            '3' => fn () => $this->handleShoppingCart(),
            '4' => fn () => $this->handleExit(),
        ];
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
        $input = readline("Type option: ");
        return trim(
            is_string($input) ? $input : '',
        );
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
     * @return void
     */
    private function handlePrinting(): void
    {
        $this->printSectionHeader('Printing');
        /** @var JsonFileLoaderService $loader */
        $loader = $this->container->get(JsonFileLoaderService::class);
        /** @var KeyValueFormatterService $formatter */
        $formatter = $this->container->get(KeyValueFormatterService::class);
        echo $formatter->format($loader->getData());
    }

    /**
     * @return void
     */
    private function handleSorting(): void
    {
        $this->printSectionHeader('Sorting');
        /** @var JsonFileLoaderService $loader */
        $loader = $this->container->get(JsonFileLoaderService::class);
        /** @var SortService $sorter */
        $sorter = $this->container->get(SortService::class);
        /** @var KeyValueFormatterService $formatter */
        $formatter = $this->container->get(KeyValueFormatterService::class);
        $data = $loader->getData();
        echo $formatter->format($sorter->sortData($data, ['first_name', 'account_id']));
    }

    /**
     * @return void
     */
    private function handleShoppingCart(): void
    {
        $this->printSectionHeader('Shopping');
        $cartService = $this->container->get(CartService::class);
        $cartService->processOrder();
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

            if (isset($this->menuHandlers[$option])) {
                $this->menuHandlers[$option]();
            } else {
                $this->handleInvalidOption();
            }
        } while ($option !== '4');
    }
}
