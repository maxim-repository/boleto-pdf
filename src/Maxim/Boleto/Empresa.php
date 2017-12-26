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
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return Empresa
     */
    public function setNome(string $nome): Empresa
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return string
     */
    public function getLogo(): string
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     * @return Empresa
     */
    public function setLogo(string $logo): Empresa
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return string
     */
    public function getCpfCnpj(): string
    {
        return $this->cpfCnpj;
    }

    /**
     * @param string $cpfCnpj
     * @return Empresa
     */
    public function setCpfCnpj(string $cpfCnpj): Empresa
    {
        $this->cpfCnpj = $cpfCnpj;

        return $this;
    }

    /**
     * @return string
     */
    public function getEndereco(): string
    {
        return $this->endereco;
    }

    /**
     * @param string $endereco
     * @return Empresa
     */
    public function setEndereco(string $endereco): Empresa
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * @return string
     */
    public function getCep(): string
    {
        return $this->cep;
    }

    /**
     * @param string $cep
     * @return Empresa
     */
    public function setCep(string $cep): Empresa
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * @return string
     */
    public function getCidade(): string
    {
        return $this->cidade;
    }

    /**
     * @param string $cidade
     * @return Empresa
     */
    public function setCidade(string $cidade): Empresa
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * @return string
     */
    public function getUf(): string
    {
        return $this->uf;
    }

    /**
     * @param string $uf
     * @return Empresa
     */
    public function setUf(string $uf): Empresa
    {
        $this->uf = $uf;

        return $this;
    }

    /**
     * @return string
     */
    public function getFone(): string
    {
        return $this->fone;
    }

    /**
     * @param string $fone
     * @return Empresa
     */
    public function setFone(string $fone): Empresa
    {
        $this->fone = $fone;

        return $this;
    }
}