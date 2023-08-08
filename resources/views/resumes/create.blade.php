<!DOCTYPE html>
<html>

<head>
    <title>Add New Resume | Resume Builder</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @include('header')
    <div class="breadcrumb custom-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('resumes.index') }}">Home</a>
        <span class="breadcrumb-item">New</span>
    </div>
</head>

<body>

    @if ($errors->any())
        <div class="container">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <br><br><br>

    <h3 class="container">Create New Resume</h3>
    <form method="post" action="{{ route('resumes.store') }}" onsubmit="return confirm('Are you sure you want to save this resume?');">
        @csrf
        <!-- Username Table -->
        <h3 class="container">Username</h3>
        <table>
            <tr class="container">
                <td class="container"><label for="username"><strong>Username</strong></label></td>
                <td><input type="text" name="username" id="username"></td>
            </tr>
        </table>
        <br><br>

        <!-- Education Table -->
        <h3 class="container">Education</h3>
        <table id="education-table">
            <thead>
                <tr>
                    <td colspan="3">
                        <div class="container">
                            <button type="button" onclick="addEducationRow()" class="btn btn-primary">Add Education</button>
                        </div>
                    </td>
                </tr>
                <tr class="container">
                    <th>Institution</th>
                    <th>Degree</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="container">
                    <td class="container"><input type="text" name="institution[]">
                    </td>
                    <td class="container"><input type="text" name="degree[]"></td>
                    <td>
                        <button type="button" onclick="deleteRow(this)" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <br><br>

        <!-- Experience Table -->
        <h3 class="container">Experience</h3>
        <table id="experience-table">
            <thead>
                <tr>
                    <td colspan="3">
                        <div class="container">
                            <button type="button" onclick="addExperienceRow()" class="btn btn-primary">Add Experience</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Company</th>
                    <th>Position</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="container">
                    <td class="container"><input type="text" name="company[]"></td>
                    <td class="container"><input type="text" name="position[]"></td>
                    <td>
                        <button type="button" onclick="deleteRow(this)" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <br><br>

        <div class="container">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('resumes.index') }}"><button type="button" class="btn btn-secondary">Back to List</button></a>
        </div>
    </form>

    <script>
        function addEducationRow() {
            const educationTable = document.querySelector("#education-table tbody");
            const newRow = document.createElement("tr");
            newRow.innerHTML = `
            <td class="container"><input type="text" name="institution[]"></td>
            <td class="container"><input type="text" name="degree[]"></td>
            <td class="container"><button type="button" onclick="deleteRow(this)" class="btn btn-danger">Delete</button></td>
        `;
            educationTable.appendChild(newRow);
        }

        function addExperienceRow() {
            const experienceTable = document.querySelector("#experience-table tbody");
            const newRow = document.createElement("tr");
            newRow.innerHTML = `
            <td class="container"><input type="text" name="company[]"></td>
            <td class="container"><input type="text" name="position[]"></td>
            <td class="container"><button type="button" onclick="deleteRow(this)" class="btn btn-danger">Delete</button></td>
        `;
            experienceTable.appendChild(newRow);
        }

        function deleteRow(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
    </script>

</body>
@include('footer')

</html>
