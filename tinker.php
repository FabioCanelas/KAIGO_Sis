App\Models\User::firstOrCreate(
    ['email' => 'canelasgodoy30@gmail.com'],
    ['name' => 'Fabio Canelas', 'password' => bcrypt('FaBIO_301806')]
);
echo "User created successfully.\n";
