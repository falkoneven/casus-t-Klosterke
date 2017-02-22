<?php

namespace App;

/**
 * Class Product
 * @package App
 */
class Product
{
    /**
     * @var string
     */
    private $naam;

    /**
     * @var integer
     */
    private $kwaliteit;

    /**
     * @var integer
     */
    private $verkopenVoor;

    /**
     * Product constructor.
     * @param $naam
     * @param $kwaliteit
     * @param $verkopenVoor
     */
    public function __construct($naam, $kwaliteit, $verkopenVoor)
    {
        $this->naam         = $naam;
        $this->kwaliteit    = $kwaliteit;
        $this->verkopenVoor = $verkopenVoor;
    }

    public function tick()
    {
        switch (true) {
            case $this->verkopenVoor <= 0:

                if($this->kwaliteit >= 2) {
                    $this->kwaliteit = $this->kwaliteit - 2;
                } else {
                    $this->kwaliteit = 0;
                }
                break;

            default:

                if($this->kwaliteit >= 1) {
                    $this->kwaliteit = $this->kwaliteit - 1;
                } else {
                    $this->kwaliteit = 0;
                }
                break;
        }

        $this->verkopenVoor = $this->verkopenVoor - 1;
    }

    /**
     * @return string
     */
    public function getNaam() {
        return $this->naam;
    }

    /**
     * @param string $naam
     */
    public function setNaam($naam) {
        $this->naam = $naam;
    }

    /**
     * @return integer
     */
    public function getKwaliteit() {
        return $this->kwaliteit;
    }

    /**
     * @param integer $kwaliteit
     */
    public function setKwaliteit($kwaliteit) {
        $this->kwaliteit = $kwaliteit;
    }

    /**
     * @return integer
     */
    public function getVerkopenVoor() {
        return $this->verkopenVoor;
    }

    /**
     * @param integer $verkopenVoor
     */
    public function setVerkopenVoor($verkopenVoor) {
        $this->verkopenVoor = $verkopenVoor;
    }
}
