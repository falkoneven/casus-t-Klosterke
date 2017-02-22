<?php

use App\Kloosterbier;
use App\Product;
use App\Rodewijn;
use App\Bbq;
use App\Wittewijn;

/*
 * Begin met werk op regel 249
 */

describe('Klosterke', function () {

    describe('#tick', function () {

        context ('normale Items', function () {

            it ('update normal itemsvoor de verkoopdatum', function () {
                $item = new Product('normal', 10, 5); // quality, sell in X days

                $item->tick();

                expect($item->getKwaliteit())->toBe(9);
                expect($item->getVerkopenVoor())->toBe(4);
            });

            it ('update normal itemsop de verkoopdatum', function () {
                $item = new Product('normal', 10, 0);

                $item->tick();

                expect($item->getKwaliteit())->toBe(8);
                expect($item->getVerkopenVoor())->toBe(-1);
            });

            it ('update normal items na de verkoopdatum', function () {
                $item = new Product('normal', 10, -5);

                $item->tick();

                expect($item->getKwaliteit())->toBe(8);
                expect($item->getVerkopenVoor())->toBe(-6);
            });

            it ('update normal items with a quality of 0', function () {
                $item = new Product('normal', 0, 5);

                $item->tick();

                expect($item->getKwaliteit())->toBe(0);
                expect($item->getVerkopenVoor())->toBe(4);
            });

        });


        context('Rode Wijn items', function () {

            it ('update Rode Wijn items voor de verkoopdatum', function () {
                $item = new Rodewijn('Rode Wijn - Merlot', 10, 5);

                $item->tick();

                expect($item->getKwaliteit())->toBe(11);
                expect($item->getVerkopenVoor())->toBe(4);
            });

            it ('update Rode Wijn items voor de verkoopdatum with maximum quality', function () {
                $item = new Rodewijn('Rode Wijn - Merlot', 50, 5);

                $item->tick();

                expect($item->getKwaliteit())->toBe(50);
                expect($item->getVerkopenVoor())->toBe(4);
            });

            it ('update Rode Wijn items op de verkoopdatum', function () {
                $item = new Rodewijn('Rode Wijn - Merlot', 10, 0);

                $item->tick();

                expect($item->getKwaliteit())->toBe(12);
                expect($item->getVerkopenVoor())->toBe(-1);
            });

            it ('update Rode Wijn items op de verkoopdatum, nabij de maximale kwaliteit', function () {
                $item = new Rodewijn('Rode Wijn - Merlot', 49, 0);

                $item->tick();

                expect($item->getKwaliteit())->toBe(50);
                expect($item->getVerkopenVoor())->toBe(-1);
            });

            it ('update Rode Wijn items op de verkoopdatum met de maximale kwaliteit', function () {
                $item = new Rodewijn('Rode Wijn - Merlot', 50, 0);

                $item->tick();

                expect($item->getKwaliteit())->toBe(50);
                expect($item->getVerkopenVoor())->toBe(-1);
            });

            it ('update Rode Wijn items na de verkoopdatum', function () {
                $item = new Rodewijn('Rode Wijn - Merlot', 10, -10);

                $item->tick();

                expect($item->getKwaliteit())->toBe(12);
                expect($item->getVerkopenVoor())->toBe(-11);
            });

            it ('update Rode Wijn items na de verkoopdatum met de maximale kwaliteit', function () {
                $item = new Rodewijn('Rode Wijn - Merlot', 50, -10);

                $item->tick();

                expect($item->getKwaliteit())->toBe(50);
                expect($item->getVerkopenVoor())->toBe(-11);
            });

        });


        context('BBQ items', function () {

            it ('update BBQ items voor de verkoopdatum', function () {
                $item = new Bbq('BBQ - Afkoop drank', 10, 5);

                $item->tick();

                expect($item->getKwaliteit())->toBe(10);
                expect($item->getVerkopenVoor())->toBe(5);
            });

            it ('update BBQ items op de verkoopdatum', function () {
                $item = new Bbq('BBQ - Afkoop drank', 10, 5);

                $item->tick();

                expect($item->getKwaliteit())->toBe(10);
                expect($item->getVerkopenVoor())->toBe(5);
            });

            it ('update BBQ items na de verkoopdatum', function () {
                $item = new Bbq('BBQ - Afkoop drank', 10, -1);

                $item->tick();

                expect($item->getKwaliteit())->toBe(10);
                expect($item->getVerkopenVoor())->toBe(-1);
            });

        });


        context('Witte Wijn', function () {
            /*
                "Witte Wijn", net zoals Rode Wijn, lopen op in kwaliteit als de verkoopVoor
                datum dichterbij komt; Kwaliteit verhoogt met 2 wanneer er 10 of minder dagen
                te gaan zijn en met 3 wanneer er 5 of minder dagen te gaan zijn. Wanneer de verkoopVoor
                datum is gepasseerd keldert de waarde naar 0
             */
            it ('update Wtte Wijn items long voor de verkoopdatum', function () {
                $item = new Wittewijn('Witte Wijn - Chardonnay', 10, 11);

                $item->tick();

                expect($item->getKwaliteit())->toBe(11);
                expect($item->getVerkopenVoor())->toBe(10);
            });

            it ('update Wtte Wijn items dicht bij de verkoopdatum', function () {
                $item = new Wittewijn('Witte Wijn - Chardonnay', 10, 10);

                $item->tick();

                expect($item->getKwaliteit())->toBe(12);
                expect($item->getVerkopenVoor())->toBe(9);
            });

            it ('update Wtte Wijn items dicht bij de verkoopdatum op de maximale kwaliteit', function () {
                $item = new Wittewijn('Witte Wijn - Chardonnay', 50, 10);

                $item->tick();

                expect($item->getKwaliteit())->toBe(50);
                expect($item->getVerkopenVoor())->toBe(9);
            });

            it ('update Wtte Wijn items dicht bij de verkoopdatum', function () {
                $item = new Wittewijn('Witte Wijn - Chardonnay', 10, 5);

                $item->tick();

                expect($item->getKwaliteit())->toBe(13); // goes up by 3
                expect($item->getVerkopenVoor())->toBe(4);
            });

            it ('update Wtte Wijn items dicht bij de verkoopdatum op de maximale kwaliteit', function () {
                $item = new Wittewijn('Witte Wijn - Chardonnay', 50, 5);

                $item->tick();

                expect($item->getKwaliteit())->toBe(50);
                expect($item->getVerkopenVoor())->toBe(4);
            });

            it ('update Wtte Wijn items met slechts 1 dag te gaan', function () {
                $item = new Wittewijn('Witte Wijn - Chardonnay', 10, 1);

                $item->tick();

                expect($item->getKwaliteit())->toBe(13);
                expect($item->getVerkopenVoor())->toBe(0);
            });

            it ('update Wtte Wijn items met slechts 1 dag te gaan op de maximale kwaliteit', function () {

                $item = new Wittewijn('Witte Wijn - Chardonnay', 50, 1);

                $item->tick();

                expect($item->getKwaliteit())->toBe(50);
                expect($item->getVerkopenVoor())->toBe(0);
            });

            it ('update Wtte Wijn items op de verkoopdatum', function () {

                $item = new Wittewijn('Witte Wijn - Chardonnay', 10, 0);

                $item->tick();

                expect($item->getKwaliteit())->toBe(0);
                expect($item->getVerkopenVoor())->toBe(-1);
            });

            it ('update Wtte Wijn items na de verkoopdatum', function () {

                $item = new Wittewijn('Witte Wijn - Chardonnay', 10, -1);

                $item->tick();

                expect($item->getKwaliteit())->toBe(0);
                expect($item->getVerkopenVoor())->toBe(-2);
            });

        });


        context ("Kloosterbier items", function () {

            it ('update Conjured items voor de verkoopdatum', function () {
                $item = new Kloosterbier('Kloosterbier - Franziskaner', 10, 10);

                $item->tick();

                expect($item->getKwaliteit())->toBe(8);
                expect($item->getVerkopenVoor())->toBe(9);
            });

            it ('update Kloosterbier items op de minimale kwaliteit', function () {
                $item = new Kloosterbier('Kloosterbier - Franziskaner', 0, 10);

                $item->tick();

                expect($item->getKwaliteit())->toBe(0);
                expect($item->getVerkopenVoor())->toBe(9);
            });

            it ('update Kloosterbier itemsop de verkoopdatum', function () {
                $item = new Kloosterbier('Kloosterbier - Franziskaner', 10, 0);

                $item->tick();

                expect($item->getKwaliteit())->toBe(6);
                expect($item->getVerkopenVoor())->toBe(-1);
            });

            it ('update Kloosterbier itemsop de verkoopdatum op de minimale kwaliteit', function () {
                $item = new Kloosterbier('Kloosterbier - Franziskaner', 0, 0);

                $item->tick();

                expect($item->getKwaliteit())->toBe(0);
                expect($item->getVerkopenVoor())->toBe(-1);
            });

            it ('update Kloosterbier items na de verkoopdatum', function () {
                $item = new Kloosterbier('Kloosterbier - Franziskaner', 10, -10);

                $item->tick();

                expect($item->getKwaliteit())->toBe(6);
                expect($item->getVerkopenVoor())->toBe(-11);
            });

            it ('update Kloosterbier items na de verkoopdatum op de minimale kwaliteit', function () {
                $item = new Kloosterbier('Kloosterbier - Franziskaner', 0, -10);

                $item->tick();

                expect($item->getKwaliteit())->toBe(0);
                expect($item->getVerkopenVoor())->toBe(-11);
            });

        });

    });

});
