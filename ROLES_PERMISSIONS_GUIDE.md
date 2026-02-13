# Rôles et Permissions E-commerce

## Structure des Rôles

### 1. Administrator (Accès Complet)
**Accès** : Toutes les permissions du système
**Permissions** :
- Users: create, read, update, delete
- Products: create, read, update, delete, publish
- Orders: create, read, update, delete, refund
- Stores: create, read, update, delete
- Analytics: read
- Reports: read, export
- Settings: manage
- Roles: manage

**Cas d'usage** : Propriétaire du site, administrateur système

---

### 2. Merchant (Accès Commercial)
**Accès** : Gestion complète des produits et commandes liés aux magasins
**Permissions** :
- Products: create, read, update, delete, publish
- Orders: read, update
- Stores: create, read, update
- Reports: read

**Cas d'usage** : Vendeurs, propriétaires de magasins

---

### 3. Manager (Accès Analytics)
**Accès** : Consultation des rapports et analyses
**Permissions** :
- Products: read
- Orders: read
- Users: read
- Analytics: read
- Reports: read, export

**Cas d'usage** : Responsables analytiques, superviseurs

---

### 4. Employee (Accès Opérationnel Restreint)
**Accès** : Opérations basiques de lecture et mise à jour
**Permissions** :
- Products: read
- Orders: read, update
- Reports: read

**Cas d'usage** : Employés logistique, support client

---

## Comment Exécuter les Seeders

### Option 1 : Exécuter tous les seeders à la fois
```bash
php artisan migrate --seed
```

### Option 2 : Exécuter les seeders individuellement
```bash
php artisan migrate
php artisan db:seed --class=Database\\Seeders\\RolePermissionSeeder
php artisan db:seed --class=Database\\Seeders\\adminSeeder
```

### Option 3 : Réinitialiser et regénérer (développement)
```bash
php artisan migrate:fresh --seed
```

---

## Tester les Rôles et Permissions

### Via Artisan Tinker
```bash
php artisan tinker
```

```php
// Voir tous les rôles
>>> use Spatie\Permission\Models\Role; Role::all();

// Voir toutes les permissions
>>> use Spatie\Permission\Models\Permission; Permission::all();

// Voir les permissions d'un utilisateur
>>> $user = \App\Models\User::where('email', 'admin@gmail.com')->first();
>>> $user->getAllPermissions();

// Vérifier un rôle
>>> $user->hasRole('Administrator');

// Vérifier une permission
>>> $user->hasPermission('users.create');
```

---

## Ajouter des Permissions à un Rôle

```php
// Dans le seeder ou via Tinker
$role = Role::findByName('Merchant');
$role->givePermissionTo('orders.refund');
```

---

## Assigner un Rôle à un Utilisateur

```php
$user = User::find($userId);
$user->assignRole('Merchant');

// Ou plusieurs rôles
$user->assignRole(['Merchant', 'Manager']);
```

---

## Supprimer un Rôle d'un Utilisateur

```php
$user->removeRole('Merchant');
```

---

## Vérifier les Permissions dans les Routes

```php
Route::get('/admin', function () {
    //
})->middleware('auth', 'role:Administrator');

// Ou pour une permission spécifique
Route::get('/users', function () {
    //
})->middleware('auth', 'permission:users.read');
```

---

## Données de Test

**Utilisateur Administrateur créé par `adminSeeder`**
- Email : `admin@gmail.com`
- Mot de passe : `12345678` (hashé en base de données)
- Rôle : Administrator
- **IMPORTANT** : Changez le mot de passe après la première connexion en production !
