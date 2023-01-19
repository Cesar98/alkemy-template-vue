## Querys

1. Delete users with 25 years old

```sql
DELETE FROM Users 
WHERE 'age' = 25;
```

```php
$users = Users::where('age', 25)->get();
foreach($users as $user){
	$user->delete();
}
```

2. Show users that were born between 1998 and 2000

```sql
SELECT name, birthday 
WHERE (birthday BETWEEN '1998/01/01' AND '2000/12/31');

SELECT name, birthday
WHERE birthday >= '1998/01/01' 
AND birthday <= '2000/12/31';
```

```php
$users = Users::whereBetween('birthday', ['1998/01/01', '2000/12/31'])->get();

$users = Users::where('birthday', '>=', '1998/01/01')->where('birthday', '<=', '2000/12/31')->get();
```

1. Show the total of tickets that each user has

```sql
SELECT name, last_name, COUNT(user_tickets.user_id) as tickets_per_person
FROM Users
LEFT JOIN user_tickets
	ON Users.id = user_tickets.user_id
GROUP BY Users.id;
```

```php
//Users model

public function tickets()
{
    return $this->hasMany(USER_TICKETS::class);
}

//controller

$users = Users::withCount('tickets')->get(); 
```

1. Show the total of tickets of each user, and order the query result from the biggest to the smallest number of tickets

```sql
SELECT name, last_name, COUNT(user_tickets.user_id) as tickets_per_person
FROM Users
LEFT JOIN user_tickets
	ON Users.id = user_tickets.user_id
GROUP BY Users.id
ORDER BY tickets_per_person DESC;
```

```php
//Users model

public function tickets()
{
    return $this->hasMany(USER_TICKETS::class);
}

//controller

$users = Users::withCount('tickets')->get();
$users->orderBy('tickets', 'desc'); 
```

1. Show the total of tickets of all users

```sql
SELECT COUNT(user_id) as tickets_total 
FROM user_tickets
```

```php
$tickets_total = USER_TICKETS::count();
```

## POO

```php

class Persona{
	public function genre(){
		print('Genre');
	}
}

class Alumno extends Persona {
	protected $name;
	//protected $genre;
	protected $age;
	protected $birthday;

	public function __construct($name, /*$genre*/, $age, $birthday){
		$this->name = $name;
		//$this->genre = $genre;
		$this->age = $age;
		$this->birthday = $birthday;
	}

	public function getName(){
		return $this->name;
	}
	public function setName($name){
		return $this->name = $name;
	}

/*
	public function getGenre(){
		return $this->genre;
	}
	public function setGenre($genre){
		return $this->genre = $genre;
	}
*/

	public function getAge(){
		return $this->age;
	}
	public function setAge($age){
		return $this->age = $age;
	}

	public function getBirthday(){
		return $this->birthday;
	}
	public function setBirthday($birthday){
		return $this->birthday = $birthday;
	}
}

```

## Project instructions

Needed requirements for installation

Latest Composer version
Laravel 9
Latest node version
XAMPP installed with PHP 8.0 or better

Visual Studio Code editor installed

1. Copy HTTPS URL from the GitHub project

2. Open a terminal or cmd tool in the htdocs carpet of your XAMPP installation

3. Clone the project, running the next command on the terminal

```
git clone https://github.com/Cesar98/alkemy-template-vue.git alkemy-template-vue
```

4. Open the project with VS Code and open the integrated terminal

5. Copy the .env.example file to a .env file (Nice to have in mind that you have to be in the root carpet project) with the next command

```
cp .env.example .env
```

6. Open PhpMyAdmin on Google Chrome, and create a new database with the name alkemy-template-vue (same name as the project)

7. Edit the .env file created, change APP_NAME to Alkemy Vue, and DB_DATABASE to alkemy-template-vue (If in the last step you created the database with user and a password, then you have to put the user and password with the one that you created it).

8. Go back to the integrated terminal of VS Code, and type the next command, this will install all necessary libraries that the project uses to work.

```
composer install
```

9. If the last command fails to run, then run

```
composer update
```

10. if both command fails to run, then check the PHP version in your computer (It might be the version of PHP).

11. In the same terminal run the next command, this will be installing all node packages and dependencies that the project uses.

```
npm install
```

12. Then run the next command, this will be creating a key to the project, this is for git purposes (All Laravel project needs this key, and cloning the project via GitHub it needs to run this command)

```
php artisan key:generate
```

13. In this next step, you are about to fill out the database (I use the Laravel User migration and create a new seeder for testing purposes)

```
php artisan migrate --seed
```

14. This is a tricky step because you have to open 2 integrated terminals on VS Code or 2 terminals out of the project, both ways you have to be on the root carpet of the project. Then run these two command lines one in one terminal. (Copy the URL that PHP artisan serve command provides, it will be useful for the next step)

```
php artisan serve
```

```
npm run dev
```

16. To navigate in the site, open the URL copied and open it in Google Chrome.
17. I provide an Admin user and different users created by the same framework to start navigating, just log in with the admin user.

```
email: admin@gmail.com
password: 1234567890
```

18. Navigate on the site, if you want to log in to a new user, first you have to edit the password of the user indeed, and then log in with the edited user
