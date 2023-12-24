<?php
require_once('config/connexion.php');

class DataFetcher
{
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function getProjectsAndTeams()
    {
        return mysqli_query($this->con, "SELECT * FROM projects, equipe WHERE equipe.id = projects.teamId");
    }

    public function getMembers()
    {
        return mysqli_query($this->con, "SELECT * FROM users WHERE role = 'member'");
    }

    public function getScrumMasters()
    {
        return mysqli_query($this->con, "SELECT DISTINCT users.*, equipe.*
            FROM users
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
                                <td class="text-center px-6 py-4">'; echo $row['project_name']; echo '</td>';
                                echo '<td class="text-center px-6 py-4">'; echo $row['description']; echo '</td>';
                                echo '<td class="text-center px-6 py-4">'; echo $row['deadline']; echo '</td>';
                                echo '<td class="text-center px-6 py-4">'; echo $row['team']; echo '</td>';
                            
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
                                Rôle
                            </th>
                        </tr>
                    </thead>
                    <tbody>';
                       
                        while ($row = mysqli_fetch_assoc($result)) {
                        
                            echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="text-center px-6 py-4">'; echo $row['firstname']; echo '</td>';
                                echo '<td class="text-center px-6 py-4">'; echo $row['lastname']; echo '</td>';
                                echo '<td class="text-center px-6 py-4">'; echo $row['phone']; echo '</td>';
                                echo '<td class="text-center px-6 py-4">'; echo $row['email']; echo '</td>';
                                echo '<td class="text-center px-6 py-4">'; echo $row['role']; echo '</td>';
            

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
                        </tr>
                    </thead>
                    <tbody>';
                       
                        while ($row = mysqli_fetch_assoc($result)) {
        
                            echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="text-center px-6 py-4">'; echo $row['firstname']; echo'</td>';
                                echo '<td class="text-center px-6 py-4">'; echo $row['lastname']; echo '</td>';
                                echo '<td class="text-center px-6 py-4">'; echo $row['phone']; echo '</td>';
                                echo '<td class="text-center px-6 py-4">'; echo $row['team']; echo '</td>';
                                echo '<td class="text-center px-6 py-4">'; echo $row['email']; echo '</td>';
                           
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
                        </tr>
                    </thead>
                    <tbody>';

                        while ($row = mysqli_fetch_assoc($result)) {

                            $id = $row['id'];
                            $teamName = $row['team'];
                            echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">';
                            echo '<td class="text-center px-6 py-4">' . $id . '</td>';
                            echo '<td class="text-center px-6 py-4">' . $teamName . '</td>';
                            echo '</tr>';
                        }
                       
                    echo '</tbody>
                </table>
            </div>';
    }
    public function MemberDelete($memberid)
    {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['memberid'])) {
        // Fetch the email from the form
        $memberid = $_POST['memberid'];
    
        // Perform the deletion query
        $delete_query = "DELETE FROM users WHERE email = '$memberid'";
        mysqli_query($this->con, $delete_query);
    
        // Redirect back to the page after deletion
        header('Location: landing_sm.php');
        exit();
    }    
    }
}