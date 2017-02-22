<?php

namespace App;

class Kloosterbier extends Product {

    public function tick()
    {
        switch (true) {

            case ($this->getVerkopenVoor() <= 0):

                if($this->getKwaliteit() > 4) {
                    $this->setKwaliteit($this->getKwaliteit() - 4);
                } else {
                    $this->setKwaliteit(0);
                }
                break;

            default:
                if($this->getKwaliteit() == 0) {
                    //
                } else {
                    $this->setKwaliteit($this->getKwaliteit() - 2);
                }
                break;
        }
        $this->setVerkopenVoor($this->getVerkopenVoor() - 1);
    }
}