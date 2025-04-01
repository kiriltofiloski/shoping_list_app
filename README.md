This is a simple shopping list app. There si only one shopping list and all regostred users may add to it, delete and edit the items.

### SETUP

1. Serve the project
   ```
   php artisan serve
   ```
2. Run migrations with seeder, this will create 2 users, `test@example.com` and `test2@example.com` (password for both: `admin123`) and will also 10 random entries in our shopping list
   ```
   php artisan migrate --seed
   php artisan storage:link
   ```

### CLI Commands

The following CLi commands are available for importing and exporting your shopping list in JSON format.

```
php artisan shopping-list:export
php artisan shopping-list:import /path/to/import.json
```

The import file shpuld resemble the example document in this repisitory `shoppingListExample.json`.
You can find the export file in `storage\app\private\exports`.

### Tests

Multiple tests have been created and can be run with

```
php artisan test
```

### Possible improvements

here are some things I would do to improve this application:
1. Add language support.
2. Add "Amount" field to model.
3. Change it so checkbox is present on the index page and updates the mdoel through an AJAX call.
4. Make a ShoppingList model and ad a foreign key to ShoppingListItem that links it to the specific list it belogns to.
5. Add a user_id field to ShoppingList s that each user can have a different shopping list.
