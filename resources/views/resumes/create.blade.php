<!DOCTYPE html>
<html>

<head>
    <title>Add New Resume | Resume Builder</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @include('header')
</head>

<body>
    <h4>Resume > New</h4>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <br><br><br>

    <h3 class="container">Create New Resume</h3>
    <form method="post" action="{{ route('resumes.store') }}">
        @csrf
        <!-- Username Table -->
        <h3 class="container">Username</h3>
        <table>
            <tr class="container">
                <td class="container"><label for="username"><strong>Username</strong></label></td>
                <td><input type="text" name="username" id="username" placeholder="Enter unique username"></td>
            </tr>
        </table>
        <br><br>

        <!-- Education Table -->
        <h3 class="container">Education</h3>
        <table id="education-table">
            <thead>
                <tr>
                    <td colspan="2">
                        <div class="container">
                            <button type="button" onclick="addEducationRow()">Add Education</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Institution</th>
                    <th>Degree</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="container"><input type="text" name="institution[]" placeholder="Enter institution">
                    </td>
                    <td class="container"><input type="text" name="degree[]" placeholder="Enter degree"></td>
                </tr>
            </tbody>
        </table>
        <br><br>

        <!-- Experience Table -->
        <h3 class="container">Experience</h3>
        <table id="experience-table">
            <thead>
                <tr>
                    <td colspan="2">
                        <div class="container">
                            <button type="button" onclick="addExperienceRow()">Add Experience</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Company</th>
                    <th>Position</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="container"><input type="text" name="company[]" placeholder="Enter company"></td>
                    <td class="container"><input type="text" name="position[]" placeholder="Enter position"></td>
                </tr>
            </tbody>
        </table>
        <br><br>

        <div class="container">
            <button type="submit">Save</button>
        </div>
    </form>

    <script>
        function addEducationRow() {
            const educationTable = document.querySelector("#education-table tbody");
            const newRow = document.createElement("tr");
            newRow.innerHTML = `
            <td class="container"><input type="text" name="institution[]" placeholder="Enter institution"></td>
            <td class="container"><input type="text" name="degree[]" placeholder="Enter degree"></td>
        `;
            educationTable.appendChild(newRow);
        }

        function addExperienceRow() {
            const experienceTable = document.querySelector("#experience-table tbody");
            const newRow = document.createElement("tr");
            newRow.innerHTML = `
            <td class="container"><input type="text" name="company[]" placeholder="Enter company"></td>
            <td class="container"><input type="text" name="position[]" placeholder="Enter position"></td>
        `;
            experienceTable.appendChild(newRow);
        }
    </script>

    <br><br>
    <div class="container">
        <a href="{{ route('resumes.index') }}"><button type="button">Back to List</button></a>
    </div>
</body>
@include('footer')

</html>
