<!DOCTYPE html>
<html>

<head>
    <title>Edit Resume | Resume Builder</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @include('header')
</head>

<body>
    <h4>Resume > Edit</h4>

    <br><br>
    <h3 class="container">Edit Resume</h3>

    <form action="{{ route('resumes.update', $resumes->id) }}" method="POST">
        @csrf
        @method('PUT')

        <table class="container">
            <tr>
                <th>Username</th>
            </tr>
            <tr>
                <td>{{ $resumes->username }}</td>
            </tr>
    </table>
        <br><br>

        <!-- Education Table -->
        <h3 class="container">Education</h3>
        <table class="container">
            <thead>
                <tr>
                    <td colspan="3">
                        <div class="container">
                            <button type="button" onclick="addEducationRow()">Add Education</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Institution</th>
                    <th>Degree</th>
                </tr>
            </thead>
            <tbody id="education_table">
                @foreach($educations as $index => $education)
                <tr>
                    <td>
                        <input type="text" name="education[{{ $index }}][id]" value="{{ $education->id ? $education->id : "" }}" readonly>
                    </td>
                    <td>
                        <input type="text" name="education[{{ $index }}][institution]" value="{{ $education->institution }}" required>
                    </td>
                    <td>
                        <input type="text" name="education[{{ $index }}][degree]" value="{{ $education->degree }}" required>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br><br>

        <!-- Experience Table -->
        <h3 class="container">Experience</h3>
        <table class="container">
            <thead>
                <tr>
                    <td colspan="3">
                        <div>
                            <button type="button" onclick="addExperienceRow()">Add Experience</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Company</th>
                    <th>Position</th>
                </tr>
            </thead>
            <tbody id="experience_table">
                @foreach($experiences as $index => $experience)
                <tr>
                    <td>
                        <input type="text" name="experience[{{ $index }}][id]" value="{{ $experience->id ? $experience->id : "" }}" readonly>
                    </td>
                    <td>
                        <input type="text" name="experience[{{ $index }}][company]" value="{{ $experience->company }}" required>
                    </td>
                    <td>
                        <input type="text" name="experience[{{ $index }}][position]" value="{{ $experience->position }}" required>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br><br>

        <div class="container">
            <button type="submit">Update Resume</button>
        </div>
        <br>
    </form>

    <script>
        var educationIndex = {{ count($educations) }};
        var experienceIndex = {{ count($experiences) }};

        function addEducationRow() {
            var table = document.getElementById("education_table");
            var row = table.insertRow();
            row.innerHTML = `
                <td></td>
                <td class="container">
                    <input type="text" name="education[${educationIndex}][institution]" required>
                </td>
                <td class="container">
                    <input type="text" name="education[${educationIndex}][degree]" required>
                </td>
            `;
            educationIndex++;
        }

        function addExperienceRow() {
            var table = document.getElementById("experience_table");
            var row = table.insertRow();
            row.innerHTML = `
                <td></td>
                <td class="container">
                    <input type="text" name="experience[${experienceIndex}][company]" required>
                </td>
                <td class="container">
                    <input type="text" name="experience[${experienceIndex}][position]" required>
                </td>
            `;
            experienceIndex++;
        }
    </script>

    <div class="container">
        <a href="{{ route('resumes.index') }}"><button type="button">Cancel</button></a>
    </div>

</body>
@include('footer')

</html>
