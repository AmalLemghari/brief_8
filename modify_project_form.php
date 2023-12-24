<?php
require_once('config/connexion.php');
require_once('class_landing_po.php');


$productOwnerUpdate = new ProjectManagement($con);
$projectName = $_POST['projectName'];
$productOwnerUpdate -> ProjectUpdate($projectName);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['projectName'])) {
    $projectName = $_POST['projectName'];

    $result = mysqli_query($con, "SELECT * FROM projects WHERE project_name = '$projectName'");

    if (!$result) {
        die('Query Error: ' . mysqli_error($con));
    }

    if ($row = mysqli_fetch_assoc($result)) {
        echo '<html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Modify Project</title>
                    <script src="https://cdn.tailwindcss.com"></script>
                </head>
                <body class="bg-gradient-to-r from-indigo-500 to-green-500 bg-no-repeat h-screen flex items-center justify-center ">
                <section class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800 w-11/12	">
                    <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">Account Updater</h2>
                            <form  method="POST" action="modify_project.php">
                                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                                    <div>
                                        <label class="text-gray-700 dark:text-gray-200" for="newProjectName">Project Name</label>
                                        <input type="hidden" name="projectName" value="' . $row['project_name'] . '">
                                        <input id="newProjectName" name="newProjectName" value="' . $row['project_name'] . '" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                    </div>

                                    <div>
                                        <label class="text-gray-700 dark:text-gray-200" for="newDescription">Description</label>
                                        <input type="hidden" name="description" value="' . $row['description'] . '">
                                        <input id="newDescription" name="newDescription" value="' . $row['description'] . '" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                    </div>

                                    <div>
                                        <label class="text-gray-700 dark:text-gray-200" for="newDeadline">Deadline</label>
                                        <input type="hidden" name="deadline" value="' . $row['deadline'] . '">
                                        <input id="newDeadline" type="date" name="newDeadline" value="' . $row['deadline'] . '" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                    </div>

                                    <div>
                                        <label class="text-gray-700 dark:text-gray-200" for="newTeamId">Team</label>
                                        <input type="hidden" name="teamId" value="' . $row['teamId'] . '">
                                        <input id="newTeamId" name="newTeamId" value="' . $row['teamId'] . '" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                    </div>
                                </div>

                                <div class="flex justify-end mt-6">
                                    <button  id="addProjectSaver" class="px-8 py-2.5 leading-5 text-white transition-colors duration-300 transform bg-gradient-to-r from-indigo-500 to-green-500 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Update</button>
                                </div>
                            </form>
                    </section>
                </body>
            </html>';

    }
}
?>
