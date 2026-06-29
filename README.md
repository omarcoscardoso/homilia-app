<div align="center">
  <img src="https://storage.googleapis.com/homilia/logo_homilia.png" alt="HomilIA Logo" width="220"/>
  <h1>HomilIA - Assistente Inteligente para Esboços de Sermões</h1>
  <p><em>Potencializando a preparação homilética e teológica com Inteligência Artificial.</em></p>

  [![Demonstração Online](https://img.shields.io/badge/Demonstra%C3%A7%C3%A3o-free.homilia.app.br-2ea44f?logo=googlechrome&logoColor=white)](https://free.homilia.app.br)
  [![Website](https://img.shields.io/website?url=https%3A%2F%2Ffree.homilia.app.br&label=homilia.app.br&color=blue)](https://free.homilia.app.br)
  [![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20.svg?logo=laravel&logoColor=white)](https://laravel.com/)
  [![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4.svg?logo=php&logoColor=white)](https://www.php.net/)
  [![Livewire](https://img.shields.io/badge/Livewire-3.x-FB70A9.svg?logo=livewire&logoColor=white)](https://livewire.laravel.com/)
  [![Gemini AI](https://img.shields.io/badge/Gemini%20AI-2.5--flash-886FBF?logo=googlegemini&logoColor=fff)](https://ai.google.dev/)
  [![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)
  [![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)
</div>

---

> 🚀 **Veja o projeto em funcionamento:** Você pode testar a aplicação ao vivo acessando [free.homilia.app.br](https://free.homilia.app.br).

---

## 📌 Sobre o Projeto

O **HomilIA** é uma aplicação web moderna projetada para auxiliar pastores, teólogos, estudantes e pregadores na criação, estruturação e organização de esboços de sermões e homilias. 

Combinando o poder do framework **Laravel 12** e componentes reativos em tempo real do **Livewire 3**, o HomilIA integra a avançada API do **Google Gemini (modelo `gemini-2.5-flash`)** para atuar como um copiloto criativo e homilético. A plataforma sugere estruturas lógicas, tópicos de desenvolvimento e insights de contextualização bíblica, sempre sob o controle e direcionamento do usuário.

---

## 🎯 Objetivo do Projeto

O objetivo principal do HomilIA é **otimizar o processo de preparação de sermões**, reduzindo o tempo gasto com formatação e estruturação inicial de ideias. 

A ferramenta busca:
* 💡 **Superar o "bloqueio da folha em branco"**: Gerar esboços bem encadeados a partir de um tema central ou texto bíblico de referência.
* 📐 **Promover clareza homilética**: Permitir a divisão do sermão em pontos e subpontos organizados de forma didática e edificante.
* 🖨️ **Facilitar a ministração**: Oferecer exportação instantânea e limpa em formato **PDF** para impressão ou leitura em dispositivos móveis durante a pregação.
* 🏛️ **Manter Rigor Arquitetural**: Servir como projeto de referência com código limpo, aplicação rigorosa dos princípios **SOLID** e design desacoplado.

---

## ✨ Principais Funcionalidades

* 🧠 **Geração de Esboços por IA**: Criação de homilias detalhadas com base no tema ou passagem selecionada.
* 📖 **Inserção de Referências Bíblicas**: Possibilidade de informar versículos chave para orientar a geração do texto.
* 🔢 **Customização de Divisões**: Escolha da quantidade exata de pontos/divisões principais para o esboço.
* ⚡ **Interface Reativa sem Reload**: Feedback visual instantâneo e geração em tempo real alimentados por **Livewire 3**.
* 📄 **Exportação Instantânea para PDF**: Conversão do esboço estilizado diretamente em arquivo PDF pronto para ministração (via DomPDF).
* 🎨 **Design Moderno e Responsivo**: Layout limpo desenvolvido com **Tailwind CSS**.

---

## 🛠️ Tecnologias e Arquitetura

O projeto adota uma arquitetura orientada a serviços e contratos (interfaces), garantindo fácil manutenção e testabilidade:

* **Back-end**: PHP 8.2+ | Laravel 12.x
* **Front-end / Interatividade**: Livewire 3 | Tailwind CSS | Vite
* **Inteligência Artificial**: SDK `google-gemini-php/laravel` (Google Gemini 2.5 Flash)
* **Geração de PDF**: `barryvdh/laravel-dompdf` & `spatie/laravel-markdown`
* **Ambiente Containerizado**: Docker | Laravel Sail | Nginx + PHP-FPM

---

## 🚀 Guia de Instalação e Configuração

### ✔️ Pré-requisitos

Antes de iniciar, certifique-se de ter instalado em sua máquina:
* **Git**
* **PHP >= 8.2** e **Composer**
* **Node.js >= 18** e **NPM**
* **Docker & Docker Compose** *(opcional, mas recomendado)*

---

### 📥 Passo a Passo

#### 1. Clonar o Repositório
```bash
git clone git@github.com:omarcoscardoso/homilia-app.git
cd homilia-app
```

#### 2. Configurar Variáveis de Ambiente
Copie o arquivo de exemplo `.env.example` para `.env`:
```bash
cp .env.example .env
```

#### 3. Instalar Dependências
```bash
composer install
npm install
```

#### 4. Gerar a Chave da Aplicação
```bash
php artisan key:generate
```

---

### ⚙️ Escolha o Método de Execução

#### Opção A: Execução via Docker (Laravel Sail - Recomendado)
Se você utiliza Docker, pode subir todo o ambiente (com banco de dados e serviços) com o Sail:
```bash
./vendor/bin/sail up -d
```
> *Nota: Na primeira execução, o Docker baixará os containers necessários.*

#### Opção B: Execução Local Nativa
Caso prefira rodar diretamente na sua máquina:
```bash
# Executa os servidores de desenvolvimento (Laravel + Vite) simultaneamente
npm run dev
# Ou em terminais separados:
php artisan serve
npm run dev
```

---

## 🔑 Configuração da API do Google Gemini

Para utilizar os recursos de IA na geração de esboços, é necessário configurar uma chave da API do Gemini:

1. Acesse o [Google AI Studio](https://aistudio.google.com/app/apikey) e crie uma chave gratuita.
2. Abra o arquivo `.env` no projeto.
3. Adicione a sua chave na variável `GEMINI_API_KEY`:
   ```ini
   GEMINI_API_KEY="SuaChaveAqui"
   ```
4. Se estiver utilizando o Laravel Sail, reinicie o container para aplicar a variável:
   ```bash
   ./vendor/bin/sail down && ./vendor/bin/sail up -d
   ```

---

## 📂 Estrutura de Pastas Relevantes

```text
homilia-app/
├── app/
│   ├── Contracts/           # Interfaces (SermonGeneratorInterface, PdfExportServiceInterface)
│   ├── Http/Controllers/    # GeminiHomiliaController (Exportação PDF)
│   ├── Livewire/            # GenerateHomilia (Componente reativo da aplicação)
│   └── Services/            # Implementações (GeminiService, SermonPromptBuilder, DomPdfExportService)
├── resources/
│   └── views/               # Views Blade e layouts
├── routes/
│   └── web.php              # Rotas da aplicação
└── Dockerfile               # Configuração multi-stage para produção (Cloud Run / Nginx)
```

---

## 🤝 Contribuição

Contribuições são extremamente bem-vindas! Se você deseja propor melhorias, novos recursos ou correções de bugs:

1. Faça um **Fork** do projeto.
2. Crie uma **Branch** para sua feature (`git checkout -b feature/nova-funcionalidade`).
3. Faça **Commit** de suas alterações (`git commit -m 'Adiciona nova funcionalidade'`).
4. Envie para o **Branch** (`git push origin feature/nova-funcionalidade`).
5. Abra um **Pull Request**.

---

## 📫 Contato & Autor

Desenvolvido por **Marcos Cardoso**.

[![LinkedIn](https://img.shields.io/badge/LinkedIn-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/omarcoscardoso/)
[![GitHub](https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github&logoColor=white)](https://github.com/omarcoscardoso)

---

<div align="center">
  <sub>Desenvolvido com 💙 para a edificação e apoio ao ministério homilético.</sub>
</div>