const campusColleges = {
    "main": ["College of Allied Health and Sciences", "College of Arts and Sciences", "College of Business and Accountancy", "College of Computer Studies", "College of Engineering and Architecture", "College of Technology"],
    "balanga": ["College of Social and Behavioral Sciences", "College of Education", "College of Business and Accountancy","Institute of Public Administration and Governance"],
    "abucay": ["College of Agriculture and Fisheries", "BCollege of Education", "Institute Of Agricultural And Biosystems Engineering"],
    "orani": ["College of Agriculture and Fisheries", "College of Education"],
    "dinalupihan": ["College of Education"],  
    "bagac": ["College of Education","College of Technology"]
  };

  function updateColleges() {
    const campusSelect = document.getElementById("campus");
    const collegeSelect = document.getElementById("college");
    const selectedCampus = campusSelect.value;

    collegeSelect.innerHTML = '<option value=""></option>';

    if (selectedCampus || campusColleges[selectedCampus]) {
      const colleges = campusColleges[selectedCampus];
      colleges.forEach(college => {
        const option = document.createElement("option");
        option.value = college;
        option.textContent = college;
        collegeSelect.appendChild(option);
      });
    }
  }