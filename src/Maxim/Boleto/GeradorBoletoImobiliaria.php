<?php

namespace Maxim\Boleto;

use fpdf\FPDF;
use Maxim\Boleto\Util\Substr;
use Maxim\Boleto\Util\UnidadeMedida;

class GeradorBoletoImobiliaria
{

    public function gerar(Array $data)
    {
        $PDF = new FPDF("P", 'mm', 'A4');

        /** @var Boleto $boleto */
        foreach ($data as $boleto) {

            $PDF->AddPage();

            $PDF->Cell(190, 6, '', 'TLR', 1, '');

            //----------------------------------------------------------------------------------------------------------
            $PDF->Cell(50, 3, '', 'L', 0, 'L');
            $PDF->Image($boleto->getEmpresa()->getLogo(), 11, 11, 30, 18);

            $PDF->SetFont('Arial', 'B', 9);
            $PDF->Cell(100, 3, utf8_decode($boleto->getEmpresa()->getNome()), '', 0, 'C');

            $PDF->SetFont('Arial', 'B', 8);
            $PDF->Cell(40, 3, '', 'R', 1, 'C');

            //----------------------------------------------------------------------------------------------------------
            $PDF->Cell(50, 3, '', 'L', 0, 'L');

            $PDF->SetFont('Arial', '', 8);
            $PDF->Cell(100, 3, utf8_decode($boleto->getEmpresa()->getEndereco()), '', 0, 'C');

            $PDF->SetFont('Arial', '', 8);
            $PDF->Cell(40, 3, 'Recibo do Pagador', 'R', 1, 'C');

            //----------------------------------------------------------------------------------------------------------
            $PDF->Cell(50, 3, '', 'L', 0, 'L');

            $PDF->SetFont('Arial', '', 8);
            $PDF->Cell(100, 3,
                utf8_decode("{$boleto->getEmpresa()->getCep()} {$boleto->getEmpresa()->getCidade()}/{$boleto->getEmpresa()->getUf()} - {$boleto->getEmpresa()->getFone()}"),
                '', 0, 'C');

            $PDF->SetFont('Arial', '', 8);
            $PDF->Cell(40, 3, $boleto->getEmpresa()->getCpfCnpj(), 'R', 1, 'C');

            //----------------------------------------------------------------------------------------------------------
            $PDF->Cell(190, 5, '', 'LR', 1, '');

            $PDF->Cell(2, 3, '', 'LR', 0, '');
            $PDF->SetFont('Arial', '', 7);
            $PDF->Cell(138, 3, '', 'T', 0, '');
            $PDF->Cell(48, 3, '', 'LTR', 0, '');
            $PDF->Cell(2, 3, '', 'R', 1, '');

            //----------------------------------------------------------------------------------------------------------
            $PDF->Cell(2, 3, '', 'LR', 0, '');
            $PDF->SetFont('Arial', '', 7);
            $PDF->Cell(18, 2, utf8_decode('CONDOMÍNIO: '), '', 0, '');
            $PDF->SetFont('Arial', 'B', 7);
            $PDF->Cell(120, 2, strtoupper(utf8_decode($boleto->getCedente()->getCondominio())), '', 0, '');
            $PDF->SetFont('Arial', '', 8);
            $PDF->Cell(48, 4, utf8_decode('VENCIMENTO'), 'LR', 0, 'C');
            $PDF->Cell(2, 3, '', 'R', 1, '');

            //----------------------------------------------------------------------------------------------------------
            $PDF->Cell(2, 3, '', 'LR', 0, '');
            $PDF->SetFont('Arial', '', 7);
            $PDF->Cell(18, 2, utf8_decode('ENDEREÇO: '), '', 0, '');
            $PDF->SetFont('Arial', 'B', 7);

            $cedenteEndereco = !is_null($boleto->getSacado()->getEnderecoLogradouro()) ? $boleto->getSacado()->getEnderecoLogradouro() : '';
            $PDF->Cell(120, 2, strtoupper(utf8_decode("$cedenteEndereco {$boleto->getSacado()->getCidade()} {$boleto->getSacado()->getUf()}")), '', 0, '');
            $PDF->SetFont('Arial', 'B', 10);
            $PDF->Cell(48, 4, $boleto->getDataVencimento()->format('d/m/Y'), 'BL', 0, 'C');
            $PDF->Cell(2, 3, '', 'LR', 1, '');

            //----------------------------------------------------------------------------------------------------------
            $PDF->Cell(2, 3, '', 'LR', 0, '');
            $PDF->SetFont('Arial', '', 7);
            $PDF->Cell(18, 2, utf8_decode('PAGADOR: '), '', 0, '');
            $PDF->SetFont('Arial', 'B', 7);
            $PDF->Cell(120, 2, strtoupper(utf8_decode("{$boleto->getSacado()->getNome()} - {$boleto->getSacado()->getCpfCnpj()}")), '', 0, '');
            $PDF->SetFont('Arial', '', 8);
            $PDF->Cell(48, 6, 'TOTAL', 'L', 0, 'C');
            $PDF->Cell(2, 3, '', 'LR', 1, '');

            //----------------------------------------------------------------------------------------------------------
            $PDF->Cell(2, 6, '', 'LR', 0, '');
            $PDF->SetFont('Arial', '', 7);
            $PDF->Cell(18, 2, utf8_decode('UNIDADE: '), '', 0, '');
            $PDF->SetFont('Arial', 'B', 7);
            $PDF->Cell(52, 2, strtoupper(utf8_decode("{$boleto->getSacado()->getUnidade()}")), '', 0, '');
            $PDF->SetFont('Arial', '', 7);
            $PDF->Cell(20, 2, utf8_decode('COMPETÊNCIA: '), '', 0, '');
            $PDF->SetFont('Arial', 'B', 7);
            $PDF->Cell(48, 2, strtoupper(utf8_decode("{$boleto->getCompetencia()}")), '', 0, '');

            $PDF->SetFont('Arial', 'B', 10);
            $PDF->Cell(48, 6, 'R$ ' . $boleto->getValorBoleto(), 'BLR', 0, 'C');
            $PDF->Cell(2, 6, '', 'R', 1, '');

            $PDF->Cell(2, 3, '', 'L', 0, '');
            $PDF->SetFont('Arial', '', 7);
            $PDF->Cell(186, 2, '', 'T', 0, '');
            $PDF->Cell(2, 3, '', 'R', 1, '');

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////

            $PDF->Cell(2, 2, '', 'LR', 0, '');
            $PDF->SetFont('Arial', '', 7);
            $PDF->Cell(186, 2, '', 'LTR', 0, '');
            $PDF->Cell(2, 2, '', 'R', 1, '');

            //----------------------------------------------------------------------------------------------------------
            $PDF->Cell(2, 3, '', 'LR', 0, '');
            $PDF->SetFont('Arial', '', 7);
            $PDF->Cell(20, 3, utf8_decode('BENEFICIÁRIO: '), '', 0, '');
            $PDF->SetFont('Arial', 'B', 7);
            $PDF->Cell(78, 3, utf8_decode($boleto->getCedente()->getNome()), '', 0, '');
            $PDF->SetFont('Arial', '', 7);
            $PDF->Cell(36, 3, utf8_decode('CPF/CNPJ DO BENEFICIÁRIO: '), '', 0, '');
            $PDF->SetFont('Arial', 'B', 7);
            $PDF->Cell(52, 3, utf8_decode($boleto->getCedente()->getCpfCnpj()), '', 0, '');
            $PDF->Cell(2, 3, '', 'LR', 1, '');

            //----------------------------------------------------------------------------------------------------------
            $PDF->Cell(2, 3, '', 'LR', 0, '');
            $PDF->SetFont('Arial', '', 7);
            $PDF->Cell(20, 3, utf8_decode('ENDEREÇO: '), '', 0, '');
            $PDF->SetFont('Arial', 'B', 7);
            $PDF->Cell(166, 3, utf8_decode("{$boleto->getCedente()->getEndereco()} | {$boleto->getCedente()->getCidade()}/{$boleto->getCedente()->getUf()}"), '', 0, '');
            $PDF->Cell(2, 3, '', 'LR', 1, '');

            //----------------------------------------------------------------------------------------------------------
            $PDF->Cell(2, 3, '', 'LR', 0, '');
            $PDF->SetFont('Arial', '', 7);
            $PDF->Cell(20, 3, utf8_decode('AGÊNCIA/CÓD: '), '', 0, '');
            $PDF->SetFont('Arial', 'B', 7);
            $PDF->Cell(55, 3, utf8_decode("{$boleto->getCedente()->getAgencia()} / {$boleto->getCedente()->getContaComDv()}"), '', 0, '');
            $PDF->SetFont('Arial', '', 7);
            $PDF->Cell(15, 3, utf8_decode('NOSSO NR: '), '', 0, '');
            $PDF->SetFont('Arial', 'B', 7);
            $PDF->Cell(33, 3, $boleto->getCarteiraENossoNumeroComDigitoVerificador(), '', 0, '');
            $PDF->SetFont('Arial', '', 7);
            $PDF->Cell(24, 3, utf8_decode('NR. DOCUMENTO: '), '', 0, '');
            $PDF->SetFont('Arial', 'B', 7);
            $PDF->Cell(39, 3, $boleto->getNumeroDocumento(), '', 0, '');
            $PDF->Cell(2, 3, '', 'LR', 1, '');

            //----------------------------------------------------------------------------------------------------------
            $PDF->Cell(2, 2, '', 'LR', 0, '');
            $PDF->SetFont('Arial', '', 7);
            $PDF->Cell(186, 2, '', 'LBR', 0, '');
            $PDF->Cell(2, 2, '', 'R', 1, '');

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////

            $PDF->Cell(2, 2, '', 'L', 0, '');
            $PDF->Cell(186, 2, '', '', 0, '');
            $PDF->Cell(2, 2, '', 'R', 1, '');

            //----------------------------------------------------------------------------------------------------------
            $PDF->Cell(2, 2, '', 'L', 0, '');
            $PDF->Cell(186, 2, '', 'LTR', 0, '');
            $PDF->Cell(2, 2, '', 'R', 1, '');

            //----------------------------------------------------------------------------------------------------------
            $PDF->Cell(2, 2, '', 'LR', 0, '');
            $PDF->SetFont('Arial', 'B', 7);
            $PDF->Cell(186, 2, 'DEMONSTRATIVO', 'LR', 0, 'C');
            $PDF->Cell(2, 2, '', 'R', 1, '');

            //----------------------------------------------------------------------------------------------------------
            $PDF->SetFont('Arial', '', 7);
            for ($i = 0, $c = 32; $i < 31; $i++, $c++) {

                $PDF->Cell(2, 3, '', 'LR', 0, '');

                $coluna1 = isset($boleto->getDemonstrativos()[$i]) ? utf8_decode($boleto->getDemonstrativos()[$i]) : '';
                $PDF->Cell(93, 3, $coluna1, '', 0, '');

                $coluna1 = isset($boleto->getDemonstrativos()[$c]) ? utf8_decode($boleto->getDemonstrativos()[$c]) : '';
                $PDF->Cell(93, 3, $coluna1, '', 0, '');
                $PDF->Cell(2, 3, '', 'RL', 1, '');
            }

            //----------------------------------------------------------------------------------------------------------
            $PDF->Cell(2, 2, '', 'LR', 0, '');
            $PDF->Cell(186, 2, '', 'B', 0, '');
            $PDF->Cell(2, 2, '', 'RL', 1, '');

            //----------------------------------------------------------------------------------------------------------
            $PDF->Cell(2, 2, '', 'L', 0, '');
            $PDF->Cell(186, 2, '', '', 0, '');
            $PDF->Cell(2, 2, '', 'R', 1, '');

            //----------------------------------------------------------------------------------------------------------
            $PDF->Cell(190, 0, '', 'B', 1, '');

            //----------------------------------------------------------------------------------------------------------
            $PDF->Ln(5);

            $PDF->Cell(50, 10, '', 'BR', 0, 'L');
            $PDF->Image(Gerador::getDirImages() . $boleto->getBanco()->getLogomarca(), 10, 171, 40, 10);
            //Select Arial italic 8
            $PDF->SetFont('Arial', 'B', 14);
            $PDF->Cell(20, 10, $boleto->getBanco()->getCodigoComDigitoVerificador(), 'LBR', 0, 'C');

            $PDF->SetFont('Arial', 'B', 11);
            $PDF->Cell(120, 10, $boleto->gerarLinhaDigitavel(), 'B', 1, 'R');

            //----------------------------------------------------------------------------------------------------------
            $PDF->SetFont('Arial', '', 6);
            $PDF->Cell(130, 3, 'Local Pagamento', 'LR', 0, 'L');
            $PDF->Cell(60, 3, 'Vencimento', 'R', 1, 'L');

            $PDF->SetFont('Arial', '', 7);
            $PDF->Cell(130, 5, utf8_decode($boleto->getBanco()->getLocalPagamento()), 'BLR', 0, 'L');
            $PDF->Cell(60, 5, $boleto->getDataVencimento()->format('d/m/Y'), 'BR', 1, 'R');

            //----------------------------------------------------------------------------------------------------------
            $PDF->SetFont('Arial', '', 6);
            $PDF->Cell(130, 3, utf8_decode('Beneficiário'), 'LR', 0, 'L');
            $PDF->Cell(60, 3, utf8_decode('Agência/Código cedente'), 'R', 1, 'L');

            //----------------------------------------------------------------------------------------------------------
            $PDF->SetFont('Arial', '', 7);
            $PDF->Cell(130, 5, utf8_decode("{$boleto->getCedente()->getNome()} - {$boleto->getCedente()->getCpfCnpj()}"), 'BLR', 0, 'L');
            $PDF->Cell(
                60,
                5,
                $boleto->getCedente()->getAgencia() . " / " . $boleto->getCedente()->getContaComDv(),
                'BR',
                1,
                'R'
            );

            //----------------------------------------------------------------------------------------------------------
            $PDF->SetFont('Arial', '', 6);
            $PDF->Cell(28, 3, 'Data Documento', 'LR', 0, 'L');
            $PDF->Cell(40, 3, utf8_decode('Número do Documento'), 'R', 0, 'L');
            $PDF->Cell(20, 3, utf8_decode('Espécie doc.'), 'R', 0, 'L');
            $PDF->Cell(20, 3, 'Aceite', 'R', 0, 'L');
            $PDF->Cell(22, 3, 'Data processamento', '', 0, 'L');
            $PDF->Cell(60, 3, utf8_decode('Carteira / Nosso número'), 'LR', 1, 'L');

            //----------------------------------------------------------------------------------------------------------
            $PDF->SetFont('Arial', '', 7);
            $PDF->Cell(28, 5, $boleto->getDataDocumento()->format('d/m/Y'), 'BLR', 0, 'L');
            $PDF->Cell(40, 5, $boleto->getNumeroDocumento(), 'BR', 0, 'L');
            $PDF->Cell(20, 5, $boleto->getBanco()->getEspecieDocumento(), 'BR', 0, 'L');
            $PDF->Cell(20, 5, $boleto->getBanco()->getAceite(), 'BR', 0, 'L');
            $PDF->Cell(22, 5, $boleto->getDataProcessamento()->format('d/m/Y'), 'BR', 0, 'L');
            $PDF->Cell(60, 5, $boleto->getCarteiraENossoNumeroComDigitoVerificador(), 'BR', 1, 'R');

            //----------------------------------------------------------------------------------------------------------
            $PDF->SetFont('Arial', '', 6);
            $PDF->Cell(28, 3, 'Uso do Banco', 'LR', 0, 'L');
            $PDF->Cell(25, 3, 'Carteira', 'R', 0, 'L');
            $PDF->Cell(15, 3, utf8_decode('Espécie'), 'R', 0, 'L');
            $PDF->Cell(40, 3, 'Quantidade', 'R', 0, 'L');
            $PDF->Cell(22, 3, '(x)Valor', '', 0, 'L');
            $PDF->Cell(60, 3, '(=)Valor Documento', 'LR', 1, 'L');

            //----------------------------------------------------------------------------------------------------------
            $PDF->SetFont('Arial', '', 7);
            $PDF->Cell(28, 5, '', 'BLR', 0, 'L');
            $PDF->Cell(25, 5, $boleto->getBanco()->getCarteira(), 'BR', 0, 'L');
            $PDF->Cell(15, 5, $boleto->getBanco()->getEspecie(), 'BR', 0, 'L');
            $PDF->Cell(40, 5, "", 'BR', 0, 'L');
            $PDF->Cell(22, 5, '', 'BR', 0, 'L');
            $PDF->Cell(60, 5, $boleto->getValorBoleto(), 'BR', 1, 'R');

            //----------------------------------------------------------------------------------------------------------
            $PDF->SetFont('Arial', '', 6);
            $PDF->Cell(130, 3, utf8_decode('Instruções (Texto de Responsabilidade do Cedente)'), 'L', 0, 'L');
            $PDF->Cell(60, 3, '(-)Desconto/Abatimentos', 'LR', 1, 'L');

            //----------------------------------------------------------------------------------------------------------
            $l = 0;
            for ($i = 0; $i < 4; $i++) {
                $instrucao = isset($boleto->getInstrucoes()[$i]) ? $boleto->getInstrucoes()[$i] : null;

                $l++;
                $PDF->Cell(130, 5, utf8_decode($instrucao), 'L', 0, 'L');

                if (1 == $l) {
                    $PDF->Cell(60, 5, '', 'LBR', 1, 'R');
                } else if (2 == $l) {
                    $PDF->SetFont('Arial', '', 6);
                    $PDF->Cell(60, 3, utf8_decode('(-)Outras deduções'), 'LR', 1, 'L');
                } else if (3 == $l) {
                    $PDF->Cell(60, 5, '', 'LBR', 1, 'R');
                } else {
                    if (4 == $l) {
                        $PDF->SetFont('Arial', '', 6);
                        $PDF->Cell(60, 3, '(+)Mora/Multa', 'LR', 1, 'L');
                    }
                }
            }

            //----------------------------------------------------------------------------------------------------------
            $PDF->SetFont('Arial', '', 7);
            $PDF->Cell(130, 5, '', 'L', 0, 'L');
            $PDF->Cell(60, 5, '', 'LBR', 1, 'R');

            //----------------------------------------------------------------------------------------------------------
            $PDF->Cell(130, 3, '', 'L', 0, 'L');
            $PDF->SetFont('Arial', '', 6);
            $PDF->Cell(60, 3, utf8_decode('(+)Outros acréscimos'), 'LR', 1, 'L');

            //----------------------------------------------------------------------------------------------------------
            $PDF->SetFont('Arial', '', 7);
            $PDF->Cell(130, 5, '', 'L', 0, 'L');
            $PDF->Cell(60, 5, '', 'LBR', 1, 'R');

            //----------------------------------------------------------------------------------------------------------
            $PDF->Cell(130, 3, '', 'L', 0, 'L');
            $PDF->SetFont('Arial', '', 6);
            $PDF->Cell(60, 3, '(=)Valor cobrado', 'LR', 1, 'L');
            $PDF->SetFont('Arial', '', 7);
            $PDF->Cell(130, 5, '', 'LB', 0, 'L');
            $PDF->Cell(60, 5, '', 'LBR', 1, 'R');

            //----------------------------------------------------------------------------------------------------------
            $PDF->SetFont('Arial', '', 6);
            $PDF->Cell(190, 3, 'Pagador', 'LR', 1, 'L');

            $PDF->SetFont('Arial', '', 7);
            $PDF->Cell(190, 5, utf8_decode("{$boleto->getSacado()->getNome()} - {$boleto->getSacado()->getCpfCnpj()}"), 'LR', 1, 'L');
            $PDF->Cell(190, 5,
                utf8_decode(
                    $boleto->getSacado()->getEnderecoLogradouro()
                ), 'LR', 1, 'L');

            //----------------------------------------------------------------------------------------------------------
            $PDF->Cell(190, 5,
                utf8_decode(
                    $boleto->getSacado()->getCidade() . " - " . $boleto->getSacado()->getUf() . " - CEP: " . $boleto->getSacado()->getCep()
                ), 'BLR', 1, 'L'
            );

            //----------------------------------------------------------------------------------------------------------
            $PDF->SetFont('Arial', '', 6);
            $PDF->Cell(170, 3, 'Sacador/Avalista', '', 0, 'L');
            $PDF->Cell(20, 3, utf8_decode('Autênticação Mecânica - Ficha de Compensação'), '', 1, 'R');

            //----------------------------------------------------------------------------------------------------------
            $this->fbarcode($boleto->getLinha(), $PDF);

            $PDF->Ln(10);
            $PDF->SetY(260);
        }

        return $PDF;
    }

    public function fbarcode($valor, FPDF $PDF)
    {
        $fino   = UnidadeMedida::px2milimetros(1); // valores em px
        $largo  = UnidadeMedida::px2milimetros(2.3); // valor em px
        $altura = UnidadeMedida::px2milimetros(40); // valor em px

        $barcodes[0] = "00110";
        $barcodes[1] = "10001";
        $barcodes[2] = "01001";
        $barcodes[3] = "11000";
        $barcodes[4] = "00101";
        $barcodes[5] = "10100";
        $barcodes[6] = "01100";
        $barcodes[7] = "00011";
        $barcodes[8] = "10010";
        $barcodes[9] = "01010";
        for ($f1 = 9; $f1 >= 0; $f1--) {
            for ($f2 = 9; $f2 >= 0; $f2--) {
                $f     = ($f1 * 10) + $f2;
                $texto = "";
                for ($i = 1; $i < 6; $i++) {
                    $texto .= substr($barcodes[$f1], ($i - 1), 1) . substr($barcodes[$f2], ($i - 1), 1);
                }
                $barcodes[$f] = $texto;
            }
        }

        // Guarda inicial
        $PDF->Image(Gerador::getDirImages() . '/p.png', $PDF->GetX(), $PDF->GetY(), $fino, $altura);
        $PDF->SetX($PDF->GetX() + $fino);
        $PDF->Image(Gerador::getDirImages() . '/b.png', $PDF->GetX(), $PDF->GetY(), $fino, $altura);
        $PDF->SetX($PDF->GetX() + $fino);
        $PDF->Image(Gerador::getDirImages() . '/p.png', $PDF->GetX(), $PDF->GetY(), $fino, $altura);
        $PDF->SetX($PDF->GetX() + $fino);
        $PDF->Image(Gerador::getDirImages() . '/b.png', $PDF->GetX(), $PDF->GetY(), $fino, $altura);
        $PDF->SetX($PDF->GetX() + $fino);

        $texto = $valor;
        if ((strlen($texto) % 2) <> 0) {
            $texto = "0" . $texto;
        }

        // Draw dos dados
        while (strlen($texto) > 0) {
            $i     = round(Substr::esquerda($texto, 2));
            $texto = Substr::direita($texto, strlen($texto) - 2);
            $f     = $barcodes[$i];
            for ($i = 1; $i < 11; $i += 2) {
                if (substr($f, ($i - 1), 1) == "0") {
                    $f1 = $fino;
                } else {
                    $f1 = $largo;
                }

                $PDF->Image(Gerador::getDirImages() . '/p.png', $PDF->GetX(), $PDF->GetY(), $f1, $altura);
                $PDF->SetX($PDF->GetX() + $f1);

                if (substr($f, $i, 1) == "0") {
                    $f2 = $fino;
                } else {
                    $f2 = $largo;
                }

                $PDF->Image(Gerador::getDirImages() . '/b.png', $PDF->GetX(), $PDF->GetY(), $f2, $altura);
                $PDF->SetX($PDF->GetX() + $f2);
            }
        }

        // Draw guarda final
        $PDF->Image(Gerador::getDirImages() . '/p.png', $PDF->GetX(), $PDF->GetY(), $largo, $altura);
        $PDF->SetX($PDF->GetX() + $largo);
        $PDF->Image(Gerador::getDirImages() . '/b.png', $PDF->GetX(), $PDF->GetY(), $fino, $altura);
        $PDF->SetX($PDF->GetX() + $fino);
        $PDF->Image(Gerador::getDirImages() . '/p.png', $PDF->GetX(), $PDF->GetY(), $fino, $altura);
        $PDF->SetX($PDF->GetX() + $fino);
        $PDF->Image(
            Gerador::getDirImages() . '/b.png',
            $PDF->GetX(),
            $PDF->GetY(),
            UnidadeMedida::px2milimetros(1),
            $altura
        );
        $PDF->SetX($PDF->GetX() + UnidadeMedida::px2milimetros(1));

    } //Fim da função

} 