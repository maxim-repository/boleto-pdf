<?php

namespace Maxim\Boleto;

class Empresa
{
    /**
     * @var string Nome
     */
    private $nome;

    /**
     * @var string Logo
     */
    private $logo;

    /**
     * @var string Cpf/Cnpj
     */
    private $cpfCnpj;

    /**
     * @var string Endereço
     */
    private $endereco;

    /**
     * @var string Cep
     */
    private $cep;

    /**
     * @var string Cidade
     */
    private $cidade;

    /**
     * @var string UF
     */
    private $uf;

    /**
     * @var string Fone
     */
    private $fone;

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return Empresa
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     * @return Empresa
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return string
     */
    public function getCpfCnpj()
    {
        return $this->cpfCnpj;
    }

    /**
     * @param string $cpfCnpj
     * @return Empresa
     */
    public function setCpfCnpj($cpfCnpj)
    {
        $this->cpfCnpj = $cpfCnpj;

        return $this;
    }

    /**
     * @return string
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param string $endereco
     * @return Empresa
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * @return string
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @param string $cep
     * @return Empresa
     */
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * @return string
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * @param string $cidade
     * @return Empresa
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * @return string
     */
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * @param string $uf
     * @return Empresa
     */
    public function setUf($uf)
    {
        $this->uf = $uf;

        return $this;
    }

    /**
     * @return string
     */
    public function getFone()
    {
        return $this->fone;
    }

    /**
     * @param string $fone
     * @return Empresa
     */
    public function setFone($fone)
    {
        $this->fone = $fone;

        return $this;
    }
}