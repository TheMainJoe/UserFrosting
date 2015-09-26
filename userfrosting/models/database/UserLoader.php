<?php

namespace UserFrosting;

/**
 * @see DatabaseInterface
 */
class UserLoader { 

    /**
     * @var DatabaseTable the table whose rows this class represents. Must be set in the child concrete class.   
     */
    protected static $_table;
    
    /**
     * Determine if a user exists based on the value of a given column.
     *
     * @param value $value The value to find.
     * @param string $name The name of the column to match (defaults to id)
     * @return bool  Returns true if a match is found, false otherwise.
     */
    public static function exists($value, $name = "id"){
        if ($name == "id")
            // Fetch by id
            return ( User::find($value) ? true : false );
        else
            // Fetch by some other column name
            return ( User::where($name, $value)->first() ? true : false );
    }
   
    /**
     * Fetch a single user based on the value of a given column.
     *
     * For non-unique columns, it will return the first entry found.  Returns false if no match is found.
     * @param value $value The value to find.
     * @param string $name The name of the column to match (defaults to id)
     * @return User
     */
    public static function fetch($value, $name = "id"){
        if ($name == "id")
            // Fetch by id
            return User::find($value);
        else
            // Fetch by some other column name
            return User::where($name, $value)->first();
    }
    
    /**
     * Fetch a list of users based on the value of a given column.  Returns empty array if no match is found.
     *
     * @param value $value The value to find. (defaults to null, which means return all records in the table)
     * @param string $name The name of the column to match (defaults to null)
     * @return array An array of User objects
     */
    public static function fetchAll($value = null, $name = null){
        if (!$value || !$name)
            $result = User::all();
        else
            $result = User::where($name, $value)->get();
            
        $users = [];
        foreach ($result as $user){
            $users[$user->id] = $user;
        }
        return $users;
    }
}