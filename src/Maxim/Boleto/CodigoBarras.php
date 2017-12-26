<?php
namespace Maxim\Boleto;

use Maxim\Boleto\Util\Substr;
use Maxim\Boleto\Util\UnidadeMedida;
use Picqer\Barcode\BarcodeGeneratorPNG;

/**
 * Class CodigoBarras
 * @package Maxim\Boleto
 */
class CodigoBarras
{

    public function gerar(Boleto $boleto)
    {
        $generator = new BarcodeGeneratorPNG();
        echo $generator->getBarcode(
            $boleto->getLinha(),
            $generator::TYPE_INTERLEAVED_2_5,
            1,
            49.13
        );
    }
}