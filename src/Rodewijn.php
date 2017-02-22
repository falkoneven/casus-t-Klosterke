<?php

namespace App;

class Rodewijn extends Product {

    public function tick()
    {
        switch (true) {
            case ($this->getVerkopenVoor() <= 0):
                if ($this->getKwaliteit() <= 48) {
                    $this->setKwaliteit($this->getKwaliteit() + 2);
                } else {
                    $this->setKwaliteit(50);
                }
                break;

            default:
                if ($this->getKwaliteit() < 50) {
                    $this->setKwaliteit($this->getKwaliteit() + 1);
                }
                break;
        }
        $this->setVerkopenVoor($this->getVerkopenVoor() - 1);
    }
}