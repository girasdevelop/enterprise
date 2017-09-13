<?php

namespace App\Contracts;

use Gate;
use Auth;
use DB;
use Validator;
use App\User;

class Update implements UpdateContract
{

    // Update data in different situations. Updating self data and data of other user when $id is given
    public function update($request, $id=NULL, $client=NULL)
    {
        if (is_numeric($id)) // If $id is given, further we work with data of other user (Not self)
        {
            if ($client==NULL)
            {
                $user = User::find($id); // Selecting data for concrete id from general model "User" and performance it like on object "$user"

            } elseif (is_object($client))
            {
                $user = $client::find($id);
            }
        } else {
            $user = Auth::user(); // Selecting data for authorized user (if $id is not given) and performance it like on object "$user"
        }

        // Checking length of posted data
        $validator = Validator::make($request->all(), [
            'phone' => 'min:6|max:15',
            'about' => 'max:255',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if(null!==($request->input('phone'))) // If "phone" field is posted from view, rewrite "phone" data in object
        {
            $user->phone = $request->input('phone');
        }
        if(null!==($request->input('about'))) // If "about" field is posted from view, rewrite "about" data in object
        {
            $user->about = stripslashes($request->input('about'));
        }
        if(null!==($request->input('salary'))) // If "salary" field is posted from view, rewrite "salary" data in object
        {
            $user->salary = $request->input('salary');
        }

        $user->save(); // Saving data in database

        // Attaching depended employees or submanagers for general manager
        if (count($request->input('attach'))>0)
        {
            if(Gate::denies('attachment') || in_array(Auth::user()->id, $request->input('attach'))) // Checking if authorized user can attach other users. Also protect situation when id authorized = id depended
            {
                abort(403); // Display error screen about limited rights to attach other users
            }
            $this->attachment($request->input('attach'), Auth::user()->id, true); // Transfer array "attach" from view with number id of employees or submanagers, id of authorized user (manager), true - to activate attaching action
        }

        // Detaching depended employees or submanagers from general manager
        if (count($request->input('detach'))>0)
        {
            if(Gate::denies('attachment')) // Checking if authorized user can attach other users
            {
                abort(403); // Display error screen about limited rights to attach other users
            }
            $this->attachment($request->input('detach')); // Transfer array "detach" from view with number id of employees or submanagers
        }

        return back()->with('message', "Data changed" ); // Go back with successful message "Data changed" on the screen
    }

    // Universal function for attach and detach employees or submanagers for/from Manager. We can transfer numeric or array with number of id in $dependent
    public function attachment($dependent, $self_id=NULL, $attach=false)
    {
        if (is_numeric($dependent))
        {
            DB::table('users')->where('id', $dependent)->update(['parent_id'=>($attach==true) ? $self_id : NULL]);//Set parent_id => id of authorized user (manager) if $attach = true (Attaching). Or set parent_id => NULL if $attach = false (Detaching).
            /*_________________________________________
              |   id   |    parent_id    |    name    |.........This is example for table structure
              |________|_________________|____________|.........
              |    1   |      NULL       |    admin   |.........
              |________|_________________|____________|.........
              |    2   |        1        |    andrey  |.........
              |________|_________________|____________|.........
              |    3   |      NULL       |    pavel   |.........
              |________|_________________|____________|.........
              ..................................................
            */
        } elseif (is_array($dependent)) {
            // If $dependent is array - do the same in circle for each line in $dependent array
            foreach ($dependent as $dep_id)
            {
                $this->attachment($dep_id, $self_id, $attach);
            }

        }

    }
}
