<?php

namespace App;

class Wittewijn extends Product {

    public function tick()
    {
        switch (true) {
            case ($this->getVerkopenVoor() <= 0):
                $this->setKwaliteit(0);
                break;

            case ($this->getVerkopenVoor() <= 5 && $this->getVerkopenVoor() >= 1):
                if ($this->getKwaliteit() <= 47) {
                    $this->setKwaliteit($this->getKwaliteit() + 3);
                } else {
                    $this->setKwaliteit(50);
                }
                break;

            case ($this->getVerkopenVoor() <= 10 && $this->getVerkopenVoor() > 5):
                if ($this->getKwaliteit() <= 48) {
                    $this->setKwaliteit($this->getKwaliteit() + 2);
                } else {
                    $this->setKwaliteit(50);
                }
                break;

            default:
                if ($this->getKwaliteit() <= 49) {
                    $this->setKwaliteit($this->getKwaliteit() + 1);
                } else {
                    $this->setKwaliteit(50);
                }
                break;
        }
        $this->setVerkopenVoor($this->getVerkopenVoor() - 1);
    }
}