<?php
require_once('config/connexion.php');

class ProjectManagement
{
    private $con;

    public function __construct($connection)
    {
        $this->con = $connection;
    }

    public function getProjects()
    {
        return mysqli_query($this->con, "SELECT * FROM projects, equipe WHERE equipe.id = projects.teamId");
    }

    public function getMembers()
    {
        return mysqli_query($this->con, "SELECT * FROM users, equipe WHERE role ='member' AND equipe.id = users.teamId");
    }

    public function getScrumMasters()
    {
        return mysqli_query($this->con, "SELECT DISTINCT users.*, equipe.* FROM users
            JOIN equipe ON equipe.id = users.teamId
            WHERE users.role = 'scrum master'");
    }

    public function getTeams()
    {
        return mysqli_query($this->con, "SELECT DISTINCT team, id FROM equipe");
    }

    public function renderProjectsTable($result)
    {
        echo '<div class="relative overflow-x-auto shadow-md ">
                <table id="projectTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 hidden ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                        <tr>

                            <th scope="col" class="px-6 py-3 text-center">
                                Project Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Deadline
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Team
                            </th>
                        </tr>
                    </thead>
                    <tbody>';
                        
                        while ($row = mysqli_fetch_assoc($result)) {
                        
                            echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="text-center px-4 py-4">'; echo $row['project_name']; echo '</td>';
                                echo '<td class="text-center px-4 py-4">'; echo $row['description']; echo '</td>';
                                echo '<td class="text-center px-4 py-4">'; echo $row['deadline']; echo '</td>';
                                echo '<td class="text-center px-4 py-4">'; echo $row['team']; echo '</td>';
                            
                        }
                            
                    echo '</tbody>
                </table>
            </div>';
    }

    public function renderMembersTable($result)
    {
        echo '<div class="relative overflow-x-auto shadow-md ">
                <table id="memberTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 hidden">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                        <tr>

                            <th scope="col" class="px-6 py-3 text-center">
                                First Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Last name
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Phone Num
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Adress E-mail
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                team
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Rôle
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>';
                        
                        while ($row = mysqli_fetch_assoc($result)) {
                        
                            echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 ">
                                <td class="text-center  ">'; echo $row['firstname']; echo '</td>';
                                echo '<td class="text-center  ">';  echo $row['lastname']; echo '</td>';
                                echo '<td class="text-center  ">';  echo $row['phone']; echo '</td>';
                                echo '<td class="text-center  ">';  echo $row['email']; echo '</td>';
                                echo '<td class="text-center  ">';  echo $row['team']; echo '</td>';
                                echo '<td class="text-center  ">';  echo $row['role']; echo '</td>';
                                echo '<td class="px-4 py-4 text-sm">'; 
                                    echo '<div class="flex items-center justify-center gap-x-6">
                                        <form method="post" action="deleteMemberForm.php">
                                            <input type="hidden" name="memberid" value="' . $row['email'] .'">';
                                            echo '<button type="submit" class="text-gray-500 transition-colors duration-200 dark:hover:text-red-500 dark:text-gray-300 hover:text-red-500 focus:outline-none j-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                        <form method="post" action="modifyTeamform.php">
                                            <input type="hidden" name="teamId" value="' . $row['teamId'] .'">';
                                            echo '<button type="submit" class="text-gray-500 transition-colors duration-200 dark:hover:text-yellow-500 dark:text-gray-300 hover:text-yellow-500 focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                            </button>
                                        </form>


                                    </div>
                                </td>
                            </tr>';
                        
                        }
                        
                    echo '</tbody>
                </table>
            </div>';
    }

    public function renderScrumMastersTable($result)
    {
        echo '<div class="relative overflow-x-auto shadow-md ">
                <table id="scrumMasterTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 hidden">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                        <tr>

                            <th scope="col" class="px-6 py-3 text-center">
                                First Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Last name
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Phone Num
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Team
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Adress E-mail
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Action 
                            </th>
                        </tr>
                    </thead>
                    <tbody>';
                        
                        while ($row = mysqli_fetch_assoc($result)) {
                        
                            echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="text-center px-4 py-4">'; echo $row['firstname']; echo '</td>';
                                echo '<td class="text-center px-4 py-4">';  echo $row['lastname']; echo'</td>';
                                echo '<td class="text-center px-4 py-4">';  echo $row['phone']; echo'</td>';
                                echo '<td class="text-center px-4 py-4">';  echo $row['team']; echo'</td>';
                                echo '<td class="text-center px-4 py-4">';  echo $row['email']; echo'</td>';
                                echo '<td class="px-4 py-4 text-sm ">';
                                    echo '<div class="flex items-center justify-center gap-x-6">
                                        <form method="post" action="modifyTeamform.php">
                                            <input type="hidden" name="teamId" value="<' . $row['teamId'] .'">';
                                            echo '<button type="submit" class="text-gray-500 transition-colors duration-200 dark:hover:text-yellow-500 dark:text-gray-300 hover:text-yellow-500 focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>';

                            
                        }
                         
                    echo '</tbody>
                </table>
            </div>';
    }

    public function renderTeamsTable($result)
    {
        echo '<div class="relative overflow-x-auto shadow-md ">
                <table id="FAQ" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 hidden">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-center">
                                Teams ID
                            </th>
                            <th scope="col" class="px-6 py-4 text-center">
                                Teams Name
                            </th>
                            <th scope="col" class="px-6 py-4 text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>';
                    
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $teamId = $row['team'];

                            echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">';
                            echo '<td class="text-center px-6 py-4">' . $id . '</td>';
                            echo '<td class="text-center px-6 py-4">' . $teamId . '</td>';
                            
                            // Add the "Delete" button in each row
                            echo '<td class="text-center px-6 py-4">';
                            echo '<form method="post" action="deleteTeamform.php">';
                            echo '<input type="hidden" name="teamId" value="' . $id . '">';
                            echo '<button type="submit" class="text-gray-500 transition-colors duration-200 dark:hover:text-red-500 dark:text-gray-300 hover:text-red-500 focus:outline-none j-center">';
                            echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">';
                            echo '<path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />';
                            echo '</svg>';
                            echo '</button>';
                            echo '</form>';
                            
                            // Add the "Update" button in each row
                            echo '<form method="post" action="modifyTeamform.php">';
                            echo '<input type="hidden" name="teamId" value="' . $id . '">';
                            echo '<button type="submit" class="text-gray-500 transition-colors duration-200 dark:hover:text-yellow-500 dark:text-gray-300 hover:text-yellow-500 focus:outline-none">';
                            echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">';
                            echo '<path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />';
                            echo '</svg>';
                            echo '</button>';
                            echo '</form>';
                            echo '</td>';
                            
                            echo '</tr>';
                        }
                        


                    echo '</tbody>
                </table>
            </div>';
    }
    public function TeamDelete($teamId)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['teamId'])) {
            // Fetch the email from the form
            $teamId = $_POST['teamId'];
        
            // Perform the deletion query
            $delete_query = "DELETE FROM equipe WHERE id = '$teamId'";
            mysqli_query($this->con, $delete_query);
        
            // Redirect back to the page after deletion
            header('Location: landing_sm.php');
            exit();
        }    
    }

    public function TeamAdd($teamname){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $teamname = $_POST['teamname'];
        
            // Use prepared statements to prevent SQL injection
            $query = "INSERT INTO equipe (team) VALUES (?)";
            $stmt = mysqli_prepare($this->con, $query);
        
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "s", $teamname);
        
            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                // Query executed successfully
                header("Location: landing_sm.php");
            } else {
                // Error handling
                echo "Error: " . mysqli_error($this->con);
            }
        
            // Close the statement and connection
            mysqli_stmt_close($stmt);
            mysqli_close($this->con);
        }
    }

    public function TeamUpdate($teamId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newteamId']) && isset($_POST['teamId'])) {
            $teamId = mysqli_real_escape_string($this->con, $_POST['teamId']);
            $newteamId = mysqli_real_escape_string($this->con, $_POST['newteamId']);
        
            // Check if the new teamId already exists
            $query = "SELECT * FROM equipe WHERE id = '$newteamId'";
            $result = mysqli_query($this->con, $query);
            if (mysqli_num_rows($result) > 0) {
                // Handle the case where the new teamId already exists
                die("Error: The new team ID already exists.");
            } else {
                // Perform the modification query
                $update_query = "UPDATE equipe SET id = '$newteamId' WHERE id = '$teamId'";
                mysqli_query($this->con, $update_query);
        
                // Redirect back to the page after modification
                header('Location: landing_sm.php');
                exit();
            }
        }
    }
}