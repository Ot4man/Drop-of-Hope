# 🩸 Drop of Hope – Plateforme de gestion des dons de sang 🩸

[![Laravel Framework](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](https://opensource.org/licenses/MIT)

> **"Chaque goutte compte, chaque donneur est un héros."**

## 📜 Présentation du Projet

**Drop of Hope** (initialement BloodConnect) est une plateforme web moderne conçue pour centraliser et structurer la gestion des dons de sang. Face aux difficultés de coordination entre les donneurs et les établissements de santé (hôpitaux et banques de sang), cette application vise à réduire les délais critiques en situation d'urgence en facilitant la mise en relation rapide entre les acteurs du don.

---

## 🚀 Fonctionnalités Clés

### 👤 Pour les Donneurs
- **Gestion du Profil** : Création de compte et mise à jour des informations personnelles (groupe sanguin, localisation, etc.).
- **Alertes de Don** : Réception de notifications en temps réel pour les demandes de don compatibles.
- **Historique Personnel** : Suivi détaillé de toutes les contributions passées.

### 🏥 Pour les Hôpitaux & Banques de Sang
- **Demandes Urgentes** : Création simplifiée de demandes de sang avec choix de la priorité.
- **Suivi des Réponses** : Visualisation en temps réel des donneurs ayant répondu favorablement à une demande.
- **Gestion des Stocks** : Meilleure visibilité sur la disponibilité locale des ressources.

### 🛡️ Pour les Administrateurs
- **Supervision Globale** : Gestion complète des comptes utilisateurs (Donneurs et Hôpitaux).
- **Tableau de Bord** : Vue d'ensemble de l'activité de la plateforme via des statistiques clés.
- **Maintenance** : Modération et assurance du bon fonctionnement technique.

---

## 🛠️ Stack Technique

- **Framework** : [Laravel 11.x](https://laravel.com)
- **Langage** : PHP 8.2+
- **Base de Données** : MySQL / PostgreSQL
- **Frontend** : Blade Templates & Vanilla CSS (ou Tailwind CSS)
- **Authentification** : Système d'authentification personnalisé (Custom Auth) sans solutions "clés en main".

---

## 🏗️ Architecture & Conception

Le projet suit des standards de développement rigoureux :
- **Design Pattern** : Utilisation de patrons de conception (ex: Repository ou Service Pattern) pour un code maintenable.
- **Sécurité** : Gestion personnalisée des rôles (Admin, Hôpital, Donneur).
- **Validation** : Rigueur dans la validation des données entrantes.

---

## ⚙️ Installation

Pour installer le projet localement, suivez ces étapes :

1.  **Cloner le dépôt** :
    ```bash
    git clone https://github.com/[username]/drop-of-hope.git
    cd drop-of-hope
    ```

2.  **Installer les dépendances PHP** :
    ```bash
    composer install
    ```

3.  **Configurer l'environnement** :
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Configurer la base de données** (éditez votre fichier `.env`) :
    ```env
    DB_DATABASE=drop_of_hope
    DB_USERNAME=votre_utilisateur
    DB_PASSWORD=votre_mot_de_passe
    ```

5.  **Exécuter les migrations** :
    ```bash
    php artisan migrate
    ```

6.  **Lancer le serveur de développement** :
    ```bash
    php artisan serve
    ```

---

## 📊 Roadmap du Projet

- [ ] **Phase 1** : Mise en place de l'authentification personnalisée et des rôles.
- [ ] **Phase 2** : Module de création de demandes de sang (Hôpitaux).
- [ ] **Phase 3** : Dashboard donneur et historique de dons.
- [ ] **Phase 4** : Statistiques et rapports administrateur.
- [ ] **Phase 5** : Système de priorisation des demandes urgentes.

---

## 📄 Licence

Ce projet est sous licence **MIT**. Voir le fichier [LICENSE](LICENSE) pour plus de détails.

---

*Développé avec ❤️ pour sauver des vies.*