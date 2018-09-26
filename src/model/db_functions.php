<?php
/** This file contains the php/sql integrated code to use when fetching data from the DB **/

/**
 * This function takes in a first and last name
 * and stores it in the database
 *
 * @param string $firstName - the firstName the user entered in the form.
 * @param string $lastName - the lastName the user enterd in the form.
 *
 * @return void
 */
function storeName($firstName, $lastName)
{
    global $dbc;

    $query = 'INSERT INTO tblNames (first_name, last_name)
        VALUES (:firstName, :lastName)';
    $statement = $dbc->prepare($query);
    $statement->bindValue(':firstName', $firstName);
    $statement->bindValue(':lastName', $lastName);
    $statement->execute();
    $statement->closeCursor();

}


/**
 * This function generates the result set of
 * the tblNames table.
 *
 * @return array $names - an assoc. array which contains all the names stored in the DB.
 */
function getAllNames()
{
    global $dbc;

    $query = 'SELECT * FROM tblNames ORDER BY last_name';
    $statement = $dbc->prepare($query);
    $statement->execute();
    $names = $statement->fetchAll();
    $statement->closeCursor();
    return $names;

}

function getAllAlbums()
{
    global $dbc;

    $query = 'SELECT * FROM albums ORDER BY album_name';
    $statement = $dbc->prepare($query);
    $statement->execute();
    $names = $statement->fetchAll();
    $statement->closeCursor();
    return $names;

}

/**
 * This function generates a result set of 10 albums.
 *
 * @return array $tenAlbums - an assoc. array which contains the name, artist, and image associated with an album that is stored in the DB.
 */
function getRandomAlbums($nextInt)
{
    global $dbc;
    $query = 'SELECT album_name, album_artist, album_image, album_id
			FROM albums
			WHERE album_id = :album_id';
    $statement = $dbc->prepare($query);
    $statement->bindValue(':album_id', $nextInt);
    $statement->execute();
    $randomAlbums = $statement->fetchAll();
    $statement->closeCursor();
    return $randomAlbums;
}

/**
 * This function generates a result set of all genres stored in the DB.
 *
 * @return array $genres - an assoc. array which contains all genres stored in the DB.
 */
function getGenres()
{
    global $dbc;
    $query = 'SELECT genre_name
			FROM genres';
    $statement = $dbc->prepare($query);
    $statement->execute();
    $genres = $statement->fetchAll();
    $statement->closeCursor();
    return $genres;
}

/**
 * This function generates a result set of all conditions stored in the DB.
 *
 * @return array $conditions - an assoc. array which contains all conditions stored in the DB.
 */
function getConditions()
{
    global $dbc;
    $query = 'SELECT condition_quality
			FROM conditions';
    $statement = $dbc->prepare($query);
    $statement->execute();
    $conditions = $statement->fetchAll();
    $statement->closeCursor();
    return $conditions;
}

/**
 * This function generates a result set of all albums in the database.
 *
 * @return array $browseAll - an assoc. array which contains the name, artist, image, year, price, format, and condition associated with an album that is stored * * in the DB.
 * TO DO: need to populate the product table in the database, and write query to pull price, format, condition, from DB
 *
 */
function browseAllAlbums($orderBy)
{
    global $dbc;
    if ($orderBy == "album_name" || $orderBy == "album_artist" || $orderBy == "album_year") {
        // XXX: $orderBy is fine but I don't like how this is done.
    } else {
        $orderBy = "album_name";
    }
    $statement = $dbc->prepare("SELECT album_name, album_artist, album_image, album_id, album_year FROM albums ORDER BY $orderBy");
    $statement->execute();
    $allAlbums = $statement->fetchAll();
    $statement->closeCursor();
    return $allAlbums;
}

/**
 * This function fetches the details of an individual album.
 *
 * @return array $albumDetails - the details associated with an album
 *
 */
function getAlbumDetails($album)
{
    global $dbc;
    $query = 'SELECT *
		FROM albums
		WHERE album_id = :album';

    $statement = $dbc->prepare($query);
    $statement->bindValue(':album', $album);
    $statement->execute();
    $albumDetails = $statement->fetchAll();
    $statement->closeCursor();
    return $albumDetails;
}

/**
 * This function generates a result set of attributes associated with an album_id stored in the DB.
 *
 * @return array $inventoryRecord - an assoc. array which contains all album_id attributes stored in the DB.
 */
function getProductInventory($album_id)
{
    global $dbc;
    $query = "SELECT
			f.format_type,
			c.condition_quality,
			p.price,
			p.albums_album_id,
			p.product_id
		FROM
			products p
				INNER JOIN
			conditions c ON p.conditions_condition_id = c.condition_id
				INNER JOIN
			formats f ON p.formats_format_id = f.format_id
		WHERE
			p.albums_album_id = :album_id";

    $statement = $dbc->prepare($query);
    $statement->bindValue(':album_id', $album_id);
    $statement->execute();
    $inventoryRecord = $statement->fetchAll();
    $statement->closeCursor();
    return $inventoryRecord;
}

/**
 * This function generates a result set of all product_ids associated with an user_id stored in the carts table in the DB.
 *
 * @return array $cartContents.
 */
function displayCart($user_id)
{
    global $dbc;
    $query = "SELECT
		c.product_qty,
		p.price,
		p.product_id,
		con.condition_quality,
		f.format_type,
		a.album_name,
		a.album_artist,
		a.album_image,
		a.album_id,
		p.price * c.product_qty AS product_subtotal
	FROM
		products p
			INNER JOIN
		carts c ON p.product_id = c.products_product_id
			INNER JOIN
		conditions con ON p.conditions_condition_id = con.condition_id
			INNER JOIN
		formats f ON p.formats_format_id = f.format_id
			INNER JOIN
		albums a ON p.albums_album_id = a.album_id
	WHERE
		c.customers_user_id = :user_id";
    $statement = $dbc->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $cartContents = $statement->fetchAll();
    $statement->closeCursor();
    return $cartContents;
}

/**
 * This function generates a result set subtotal and totals of a user's carts table in the DB.
 *
 * @return array $cartContents.
 */
function cartSums($user_id)
{
    global $dbc;
    $query = "SELECT
		SUM(c.product_qty*p.price) AS cart_subtotal,
		ROUND(SUM(c.product_qty*p.price)+(.12*SUM(c.product_qty*p.price)), 2) AS cart_total
			FROM
		products p
			INNER JOIN
		carts c ON p.product_id = c.products_product_id
	WHERE
		c.customers_user_id = :user_id";
    $statement = $dbc->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $cartSums = $statement->fetchAll();
    $statement->closeCursor();
    return $cartSums;
}

/**
 * This function adds a product_id and quantity to user's carts table in the DB.
 *
 * @return int $confirm - to confirm if update was successful.
 */
function addItem($user_id, $product_id, $quantity)
{
    global $dbc;
    //first we need to know if item is already saved to user's cart
    $query1 = "SELECT product_qty
        FROM carts
        WHERE customers_user_id = :user_id
        AND products_product_id = :product_id";
    $statement = $dbc->prepare($query1);
    $statement->bindValue(':user_id', $user_id);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $itemCheck = $statement->fetchAll();
    $statement->closeCursor();

    if (count($itemCheck) > 0) //need to confirm if query1 returned any rows
    {
        //if item is already saved to user's cart, we need to update quantity record only, so we add current quantity to quantity parameter.
        $newQuantity = $itemCheck[0][0];
        $newQuantity = $newQuantity + $quantity;
        $query2 = "UPDATE carts
                SET product_qty=:quantity
                WHERE customers_user_id = :user_id
                AND products_product_id = :product_id";
        $statement = $dbc->prepare($query2);
        $statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':quantity', $newQuantity);
        $statement->bindValue(':product_id', $product_id);
        $statement->execute();
        $statement->closeCursor();
        $confirm = 1;
        return $confirm;
    } else {
        //we know this item does not exist in cart, as so we add the product_id and quantity to the cart
        $query2 = "INSERT INTO carts
					(customers_user_id, products_product_id, product_qty)
					VALUES
					(:user_id, :product_id, :quantity)";
        $statement = $dbc->prepare($query2);
        $statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':product_id', $product_id);
        $statement->bindValue(':quantity', $quantity);
        $statement->execute();
        $statement->closeCursor();
        $confirm = 1;
        return $confirm;
    }
}

/**
 * This function deletes a product_id and quantity from user's carts table in the DB.
 *
 * @return int $confirm - to confirm if update was successful.
 */
function deleteItem($user_id, $product_id)
{
    global $dbc;
    $query = "DELETE FROM carts
		WHERE
		customers_user_id = :user_id
		AND
		products_product_id = :product_id";
    $statement = $dbc->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $statement->closeCursor();
    $confirm = 1;
    return $confirm;
}

function emptyCart($user_id)
{
    global $dbc;
    $query = "DELETE FROM carts
		WHERE
		customers_user_id = :user_id";
    $statement = $dbc->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $statement->closeCursor();
    $confirm = 1;
    return $confirm;
}

function customSearch($artist, $album)
{
    global $dbc;
    $query = 'SELECT
			album_name, album_artist, album_image, album_id, album_year
			FROM albums
			WHERE album_name LIKE :album
			AND album_artist LIKE :artist
			ORDER BY album_year';
    $statement = $dbc->prepare($query);
    $statement->bindValue(':album', '%' . $album . '%');
    $statement->bindValue(':artist', '%' . $artist . '%');
    $statement->execute();
    $searchResults = $statement->fetchAll();
    $statement->closeCursor();
    return $searchResults;
}

function updateItem($user_id, $quantity, $product_id)
{
    global $dbc;
    $query = "UPDATE carts
			SET product_qty = :quantity
			WHERE customers_user_id = :user_id
			AND products_product_id = :product_id";
    $statement = $dbc->prepare($query);
    $statement->bindValue(':quantity', $quantity);
    $statement->bindValue(':user_id', $user_id);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $statement->closeCursor();
    $confirm = 1;
    return $confirm;

}

function suggestedItems($genreid)
{
    //problem: using the parameter album id and it's associated genre_id, we want then query the database to fetch the album_id and album_image  genre_id
    global $dbc;
    $query = "SELECT
		genre_id
	FROM
		products p
			INNER JOIN
		albums a ON p.albums_album_id = a.album_id
			INNER JOIN
		albums_has_genre ag ON a.album_id = ag.albums_album_id
			INNER JOIN
		genres g ON ag.genre_genre_id = g.genre_id
	WHERE p.product_id = :genreid";
    $statement = $dbc->prepare($query);
    $statement->bindValue(':genreid', $genreid);
    $statement->execute();
    $genre = $statement->fetchAll();
    $statement->closeCursor();

    $genreID = $genre[0][0][0];

    global $dbc;
    $query = "SELECT
		album_id,
		album_image,
		album_artist
		FROM
		albums a
				INNER JOIN
			albums_has_genre ag ON a.album_id = ag.albums_album_id
				INNER JOIN
			genres g ON ag.genre_genre_id = g.genre_id
		WHERE ag.genre_genre_id = :genreID";
    $statement = $dbc->prepare($query);
    $statement->bindValue(':genreID', $genreID);
    $statement->execute();
    $suggestedItems = $statement->fetchAll();
    $statement->closeCursor();
    return $suggestedItems;
}

function newClient($firstname, $lastname, $email, $password)
{
	$options = [ 
		'cost' => 9,
	];
	$hashPass = password_hash($password, PASSWORD_BCRYPT, $options);
	
    global $dbc;
    $query = "INSERT INTO customers 
		(first_name, last_name, email, password)
        VALUES 
		(:first_name, :last_name, :email, :password)";
    $statement = $dbc->prepare($query);
    $statement->bindValue(':first_name', $firstname);
    $statement->bindValue(':last_name', $lastname);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $hashPass);
    $statement->execute();
    $statement->closeCursor();
		
	$query = "SELECT *
		FROM customers
		WHERE email = :email
		AND first_name = :firstname
		AND password = :password";
	$statement = $dbc->prepare($query);
	$statement->bindValue(':email', $email);
	$statement->bindValue(':firstname', $firstname);
    $statement->bindValue(':password', $hashPass);
	$statement->execute();
	$confirm = $statement->fetchAll();
	$statement->closeCursor();
    return $confirm;
}
