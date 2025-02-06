<?php

require_once '../Conexao.php';

class Fornecedor {
    // Propriedades privadas
    private $id;
    private $razaoSocial;
    private $cnpj;
    private $logradouro;
    private $num;
    private $bairro;
    private $cidade;
    private $complemento;
    private $uf;
    private $cep;
    private $codigoMunicipio;

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getRazaoSocial(): string {
        return $this->razaoSocial;
    }

    public function getCnpj(): string {
        return $this->cnpj;
    }

    public function getLogradouro(): string {
        return $this->logradouro;
    }

    public function getNum(): string {
        return $this->num;
    }

    public function getBairro(): string {
        return $this->bairro;
    }

    public function getCidade(): string {
        return $this->cidade;
    }

    public function getComplemento(): ?string {
        return $this->complemento;
    } // Retorna nulo se complemento for vazio

    public function getUf(): string {
        return $this->uf;
    }

    public function getCep(): string {
        return $this->cep;
    }

    public function getCodigoMunicipio(): string {
        return $this->codigoMunicipio;
    }

    // Setters
    public function setRazaoSocial(string $razaoSocial): void {
        $this->razaoSocial = $razaoSocial;
    }

    public function setCnpj(string $cnpj): void {
        $this->cnpj = $cnpj;
    }

    public function setLogradouro(string $logradouro): void {
        $this->logradouro = $logradouro;
    }

    public function setNum(string $num): void {
        $this->num = $num;
    }

    public function setBairro(string $bairro): void {
        $this->bairro = $bairro;
    }

    public function setCidade(string $cidade): void {
        $this->cidade = $cidade;
    }

    public function setComplemento(?string $complemento): void {
        $this->complemento = $complemento;
    }

    public function setUf(string $uf): void {
        $this->uf = $uf;
    }

    public function setCep(string $cep): void {
        $this->cep = $cep;
    }

    public function setCodigoMunicipio(string $codigoMunicipio): void {
        $this->codigoMunicipio = $codigoMunicipio;
    }
}