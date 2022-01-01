class globalclass {
    constructor(baseurl) {
        var base_url = window.location.origin;
        this.url = `${base_url}/NASH_HRMS/public/`;
        this.headers = `headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }`;
    }
    async statelist(id, url = "..") {
        return await axios
            .get(`${this.url}/companies/getStateDetails/` + id)
            .then((response) => response.data.data)
            .catch((error) => console.log(error));
    }
    async citylist(id, url = "..") {
        return await axios
            .get(`${this.url}/companies/getCityDetails/` + id)
            .then((response) => response.data.data)
            .catch((error) => console.log(error));
    }
    async globalvariable(datas) {
        let list = "";
        try {
            list = await axios.get(`${this.url}api/jsonval/` + datas);
        } catch (err) {
            console.log(err);
        }
        return list;
    }
    tempid_details(str) {
        let stringval = str.replace(/[^A-Z0-9]+/gi, "_");
        let timestamp = new Date().getTime();
        return stringval + "T" + timestamp;
    }
    //self.htmlelement('First Name','input','text',['form-control','sample'],'firstname','First Name','required')
    async inputelement(
        headlabel = "",
        ele,
        eletype,
        eleclass = [],
        eleid,
        eleplaceholder = "",
        elerequired = "",
        elevalue = ""
    ) {
        if (ele == "input" && eletype == "text") {
            let eleclassval = eleclass.length > 0 ? eleclass.join(" ") : "";
            return `<div class="col-md-4">
                         <div class="form-group">
                            <label>${headlabel}</label>
                            <input type="text" class="${eleclassval}" id="${eleid}" placeholder="${eleplaceholder}" value="${elevalue}">
                         </div>
                        </div>`;
        }
    }
    //selectemelent(label,inputtype,'class',id,optionvalue,opetionselected)
    async selectelement(
        headlabel = "",
        ele,
        eleclass = [],
        eleid,
        eleoption = [],
        ele_op_val
    ) {
        if (eleoption.length > 0) {
            let option = "";
            $.each(eleoption[0], function (key, val) {
                option += `<option value="${val}" ${
                    ele_op_val != "" && ele_op_val == val ? "selected" : ""
                }>${key}</option>`;
            });
            let eleclassval = eleclass.length > 0 ? eleclass.join(" ") : "";
            return `<div class="col-md-4">
            <div class="form-group">
               <label>${headlabel}</label>
               <select class="${eleclassval}" id="${eleid}">${option}</select>               
            </div>
           </div>`;
        }
    }
    async labelelement(
        headlabel,
        icons,
        headclass = [],
        eleclass = [],
        eleval,
        divclass = ""
    ) {
        let eleclassval = eleclass.length > 0 ? eleclass.join(" ") : "";
        let headclassval = headclass.length > 0 ? headclass.join(" ") : "";
        let iconvalue = "";
        if (icons != "") {
            iconvalue = `<i class="fa ${icons}" aria-hidden="true" style="color:grey"></i>`;
        }
        let class_of_div = "";
        if (divclass == "") {
            class_of_div = "col-3 col-md-3 col-xs-3 col-sm-3";
        } else {
            class_of_div = divclass;
        }

        return `<div class="${class_of_div}">       
        <ul>
           <li class="${headclassval}">${iconvalue} ${headlabel}</li>
           <li class="${eleclassval}"> ${eleval}</li>
        </ul>
       </div>`;
    }
    valdateundefined(col) {
        if (col == undefined && col == null) {
            return "";
        } else {
            return col;
        }
    }
    datepickers() {
        $(".datepicker").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            yearRange: "1972:2020",
        });
    }
    successmethod(parentid, msg) {
        $("body")
            .find("#" + parentid)
            .find("#success")
            .html(msg);
    }
    errormethod(parentid, childid, msg) {
        $("body")
            .find("#" + parentid)
            .find("#error")
            .html(msg + "*");
        $("body")
            .find("#" + parentid)
            .find("#" + childid)
            .focus();
        return false;
    }
}
class employeeClass extends globalclass {
    constructor(idname, employee = {}, departments = {}) {
        super();
        this.departmentsdetails = departments;
        this.employeedetails = employee;
        this.id = idname;
        this.defaultmethod();
    }
    defaultmethod() {
        var self = this;
        if (self.id == "employeecreate") {
            let state_code = "";
            let country_code = "";
            self.departmentsdetails = JSON.parse(self.departmentsdetails);
            $("#company_country").on("change", function () {
                country_code = $(this).val();
                self.stateupdate(country_code, "0", ".");
                self.cityupdate("0", "0", ".");
            });
            $("#company_state").on("change", function () {
                state_code = $(this).val();
                self.cityupdate(state_code, "0", ".");
            });
            $("#department_id").on("change", function () {
                //console.log();
                let find_deptinfo = self.departmentsdetails.find(
                    (deptinfo) => deptinfo.deptcode == $(this).val()
                );
                $("#deptname").val(find_deptinfo.deptname);
                $("#deptdescription").val(find_deptinfo.deptdescription);
                $("#plant_id").val(find_deptinfo.plant_id);
                $("#company_id").val(find_deptinfo.company_id);
                $("#company_name").val(find_deptinfo.company_name);
            });
            $("#emprole").on("change", function () {
                let thisvalue = $(this).val();
                if (thisvalue == "contract") {
                    $("#contractor").show();
                }
            });
        }
        if (self.id == "employeeedit") {
            self.departmentsdetails = JSON.parse(self.departmentsdetails);
            self.employeedetails = JSON.parse(self.employeedetails);
            $("#company_country").val(
                self.employeedetails.company_country != null
                    ? self.employeedetails.company_country
                    : ""
            );
            var emprole = $("#emprole").val();
            if (emprole == "contract") {
                $("#contractor").show();
            }
            let state_code = self.employeedetails.company_state;
            let country_code = self.employeedetails.company_country;
            let city_code = self.employeedetails.company_city;
            self.stateupdate(country_code, state_code);
            self.cityupdate(state_code, city_code);
            $("#company_country").on("change", function () {
                country_code = $(this).val();
                self.stateupdate(country_code, "0", ".");
                self.cityupdate("0", "0", ".");
            });
            $("#company_state").on("change", function () {
                state_code = $(this).val();
                self.cityupdate(state_code, "0", ".");
            });
            $("#department_id").on("change", function () {
                //console.log();
                let find_deptinfo = self.departmentsdetails.find(
                    (deptinfo) => deptinfo.deptcode == $(this).val()
                );
                $("#deptname").val(find_deptinfo.deptname);
                $("#deptdescription").val(find_deptinfo.deptdescription);
                $("#plant_id").val(find_deptinfo.plant_id);
                $("#company_id").val(find_deptinfo.company_id);
                $("#company_name").val(find_deptinfo.company_name);
            });
            $("#emprole").on("change", function () {
                let thisvalue = $(this).val();
                if (thisvalue == "contract") {
                    $("#contractor").show();
                }
            });
            $("#empname").val($("#empoldvalue").val());
        }
    }
    stateupdate(country_code, state_code = "0", url) {
        let self = this;
        self.statelist(country_code, url).then((res) => {
            let companystate = "<option value=''>Choose state</option>";
            $.each(res, function (key, value) {
                if (state_code == value.id) {
                    companystate += `<option value=${value.id} selected>${value.state_name}</option>`;
                } else {
                    companystate += `<option value=${value.id}>${value.state_name}</option>`;
                }
            });
            $("#company_state").html(companystate);
        });
    }
    cityupdate(state_code, city_code = "0", url) {
        let self = this;
        let companycity = "<option value=''>Choose city</option>";
        if (state_code != "0") {
            self.citylist(state_code, url).then((res) => {
                $.each(res, function (key, value) {
                    if (city_code == value.id) {
                        companycity += `<option value=${value.id} selected>${value.city_name}</option>`;
                    } else {
                        companycity += `<option value=${value.id}>${value.city_name}</option>`;
                    }
                });
                $("#company_city").html(companycity);
            });
        } else {
            $("#company_city").html(companycity);
        }
    }
}
class plantsClass extends globalclass {
    constructor(idname, plants = {}, company = {}) {
        super();
        this.plantdetails = plants;
        this.companydetails = company;
        this.id = idname;
        this.defaultmethod();
    }
    defaultmethod() {
        var self = this;
        if (self.id == "plantcreate") {
            let state_code = "";
            let country_code = "";
            self.companydetails = JSON.parse(self.companydetails);
            $("#company_country").on("change", function () {
                country_code = $(this).val();
                self.stateupdate(country_code, "0", ".");
                self.cityupdate("0", "0", ".");
            });
            $("#company_state").on("change", function () {
                state_code = $(this).val();
                self.cityupdate(state_code, "0", ".");
            });
            $("#company_id").on("change", function () {
                let find_company = self.companydetails.find(
                    (company) => company.company_code == $(this).val()
                );
                $("#company_name").val(find_company.company_name);
            });
        }
        if (self.id == "plantedit") {
            self.plantdetails = JSON.parse(self.plantdetails);
            self.companydetails = JSON.parse(self.companydetails);

            $("#company_country").val(
                self.plantdetails.company_country != null
                    ? self.plantdetails.company_country
                    : ""
            );
            let state_code = self.plantdetails.company_state;
            let country_code = self.plantdetails.company_country;
            let city_code = self.plantdetails.company_city;
            self.stateupdate(country_code, state_code);
            self.cityupdate(state_code, city_code);
            $("#company_country").on("change", function () {
                country_code = $(this).val();
                self.stateupdate(country_code, "0", ".");
                self.cityupdate("0", "0", ".");
            });
            $("#company_state").on("change", function () {
                state_code = $(this).val();
                self.cityupdate(state_code, "0", ".");
            });
            $("#company_id").on("change", function () {
                let find_company = self.companydetails.find(
                    (company) => company.company_code == $(this).val()
                );
                $("#company_name").val(find_company.company_name);
            });
        }
    }
    stateupdate(country_code, state_code = "0", url) {
        let self = this;
        self.statelist(country_code, url).then((res) => {
            let companystate = "<option value=''>Choose state</option>";
            $.each(res, function (key, value) {
                if (state_code == value.id) {
                    companystate += `<option value=${value.id} selected>${value.state_name}</option>`;
                } else {
                    companystate += `<option value=${value.id}>${value.state_name}</option>`;
                }
            });
            $("#company_state").html(companystate);
        });
    }
    cityupdate(state_code, city_code = "0", url) {
        let self = this;
        let companycity = "<option value=''>Choose city</option>";
        if (state_code != "0") {
            self.citylist(state_code, url).then((res) => {
                $.each(res, function (key, value) {
                    if (city_code == value.id) {
                        companycity += `<option value=${value.id} selected>${value.city_name}</option>`;
                    } else {
                        companycity += `<option value=${value.id}>${value.city_name}</option>`;
                    }
                });
                $("#company_city").html(companycity);
            });
        } else {
            $("#company_city").html(companycity);
        }
    }
}

class departmentcreate {
    constructor(idname) {
        this.id = idname;
        this.defaultmethod();
    }
    defaultmethod() {
        let self = this;
        if (self.id == "DepartmentCreateBlade") {
            $("#" + self.id).on("change", "#plant_id", function () {
                var company_name =
                    $(this).find("option:selected").data("companyname") !=
                    undefined
                        ? $(this).find("option:selected").data("companyname")
                        : "";
                var company_id =
                    $(this).find("option:selected").data("company_id") !=
                    undefined
                        ? $(this).find("option:selected").data("company_id")
                        : "";
                $("#" + self.id)
                    .find("#company_name")
                    .val(company_name);
                $("#" + self.id)
                    .find("#company_id")
                    .val(company_id);
            });
        }
        if (self.id == "Departmentedit") {
            $("#" + self.id).on("change", "#plant_id", function () {
                var company_name =
                    $(this).find("option:selected").data("companyname") !=
                    undefined
                        ? $(this).find("option:selected").data("companyname")
                        : "";
                var company_id =
                    $(this).find("option:selected").data("company_id") !=
                    undefined
                        ? $(this).find("option:selected").data("company_id")
                        : "";
                $("#" + self.id)
                    .find("#company_name")
                    .val(company_name);
                $("#" + self.id)
                    .find("#company_id")
                    .val(company_id);
            });
            $("#deptincharge").val($("#departname").val());
        }
    }
}
class company extends globalclass {
    constructor(idname, company = {}, country = {}) {
        super();
        this.companydetails = company;
        this.id = idname;
        this.defaultmethod();
    }

    defaultmethod() {
        var self = this;
        if (self.id == "companyedit") {
            self.companydetails = JSON.parse(self.companydetails);
            $("#company_country").val(
                self.companydetails.company_country != null
                    ? self.companydetails.company_country
                    : ""
            );
            let state_code = self.companydetails.company_state;
            let country_code = self.companydetails.company_country;
            let city_code = self.companydetails.company_city;
            self.stateupdate(country_code, state_code);
            self.cityupdate(state_code, city_code);
            $("#company_country").on("change", function () {
                country_code = $(this).val();
                self.stateupdate(country_code, "0", "..");
                self.cityupdate("0", "0", "..");
            });
            $("#company_state").on("change", function () {
                state_code = $(this).val();
                //self.stateupdate(country_code, "0");
                self.cityupdate(state_code, "0", "..");
            });
        }
        if (self.id == "companycreate") {
            let state_code = "";
            let country_code = "";
            $("#company_country").on("change", function () {
                country_code = $(this).val();
                self.stateupdate(country_code, "0", ".");
                self.cityupdate("0", "0", ".");
            });
            $("#company_state").on("change", function () {
                state_code = $(this).val();
                self.cityupdate(state_code, "0", ".");
            });
        }
    }

    stateupdate(country_code, state_code = "0", url) {
        let self = this;
        self.statelist(country_code, url).then((res) => {
            let companystate = "<option value=''>Choose state</option>";
            $.each(res, function (key, value) {
                if (state_code == value.id) {
                    companystate += `<option value=${value.id} selected>${value.state_name}</option>`;
                } else {
                    companystate += `<option value=${value.id}>${value.state_name}</option>`;
                }
            });
            $("#company_state").html(companystate);
        });
    }
    cityupdate(state_code, city_code = "0", url) {
        let self = this;
        let companycity = "<option value=''>Choose city</option>";
        if (state_code != "0") {
            self.citylist(state_code, url).then((res) => {
                $.each(res, function (key, value) {
                    if (city_code == value.id) {
                        companycity += `<option value=${value.id} selected>${value.city_name}</option>`;
                    } else {
                        companycity += `<option value=${value.id}>${value.city_name}</option>`;
                    }
                });
                $("#company_city").html(companycity);
            });
        } else {
            $("#company_city").html(companycity);
        }
    }
}
class joiningPersonal extends globalclass {
    constructor(id, basic = {}, country = {}) {
        super();
        this.profileimage();
        this.defaultmethod();
        this.datepickers();
        this.P_B_DB = JSON.parse(basic);
        this.templatebodyloading();
        this.educationtemplateloading();
        this.employementtemplateloading();
        this.skilltemplateloading();
        this.countrydetails = JSON.parse(country);
    }

    async pendingDetails() {
        let self = this;
        let pending = "";

        let profile_image = await self.databasevalue("profile_img");
        if (profile_image == "") {
            pending += `<li>Add Photo</li>`;
        }
        let personal = `<li>Add Personal Details</li>`;
        let marksheet = `<li>Add Marksheet Details</li>`;
        let employ = `<li>Add Employment Details</li>`;
        let employeefiles = await self.getemployeefiles(self.P_B_DB.id);

        if (employeefiles.status == 200) {
            if (employeefiles.data.details.length > 0) {
                let filesDet = employeefiles.data.details;

                $.each(filesDet, function (k, v) {
                    if (v.file_base_path == "personal") {
                        personal = "";
                    }
                    if (v.file_base_path == "education") {
                        marksheet = "";
                    }
                    if (v.file_base_path == "previousemployee") {
                        employ = "";
                    }
                });
            }
        }
        pending += personal;
        pending += marksheet;
        pending += employ;
        $("body").find("#pending_details").html(pending);
    }
    async templatebodyloading() {
        let self = this;
        self.P_P_DB = "";
        let parentID = $("#personal_section");
        let imgdiv = `<div style="min-width:766px;min-height:214px;text-align:center;"><img style="margin-top:10%" src="${self.url}img/loader.gif") }}"></div>`;
        parentID.find(".bodys").html(imgdiv);

        self.P_P_DB = await self.getpersonaldetails();
        if (self.P_P_DB.status == "200") {
            self.P_P_DB = self.P_P_DB.data.details["0"];
        }
        if (self.P_P_DB != "") {
            try {
                let profile_image = await self.databasevalue("profile_img");
                if (profile_image != "") {
                    $("body")
                        .find(".profile-pic")
                        .attr(
                            "src",
                            `${self.url}storage/profile/${profile_image}`
                        );
                }
                if ((await self.databasevalue("mobileno")) != "") {
                    $("#header_mobile").html(
                        `<i class="fa fa-mobile"></i><span id=""><span>${await self.databasevalue(
                            "mobileno"
                        )}</span>`
                    );
                }
                if ((await self.databasevalue("email_id")) != "") {
                    $("#header_email").html(
                        `<i class="fa fa-envelope" aria-hidden="true"></i><span >${await self.databasevalue(
                            "email_id"
                        )}</span>`
                    );
                }

                let temp_data_basic = await self.personaldetailsdata();

                parentID.find(".bodys").html(temp_data_basic);
            } catch (error) {
                console.log(error);
            }
        }
        await self.pendingDetails();
    }

    async educationtemplateloading() {
        let self = this;
        // self.P_P_DB = "";
        let parentID = $("#education_section");
        let imgdiv = `<div style="min-width:766px;min-height:214px;text-align:center;"><img style="margin-top:10%" src="${self.url}img/loader.gif") }}"></div>`;
        parentID.find(".edubodys").html(imgdiv);
        await self.selfedu();
        if (self.P_E_DB != "") {
            try {
                let temp_data_basic = await self.educationdetailsdata();
                parentID.find(".edubodys").html(temp_data_basic);
            } catch (error) {
                console.log(error);
            }
        }
        await self.pendingDetails();
    }
    async employementtemplateloading() {
        let self = this;
        // self.P_P_DB = "";
        let parentID = $("#employment_section");
        let imgdiv = `<div style="min-width:766px;min-height:214px;text-align:center;"><img style="margin-top:10%" src="${self.url}img/loader.gif") }}"></div>`;
        parentID.find(".empbodys").html(imgdiv);
        await self.selfedu();
        if (self.P_E_DB != "") {
            try {
                let temp_data_basic = await self.employmentdetailsdata();
                parentID.find(".empbodys").html(temp_data_basic);
            } catch (error) {
                console.log(error);
            }
        }
    }
    async skilltemplateloading() {
        let self = this;
        // self.P_P_DB = "";
        let parentID = $("#skillset_section");
        let imgdiv = `<div style="min-width:766px;min-height:214px;text-align:center;"><img style="margin-top:10%" src="${self.url}img/loader.gif") }}"></div>`;
        parentID.find(".skillbodys").html(imgdiv);
        await self.selfedu();
        if (self.P_E_DB != "") {
            try {
                let temp_data_basic = await self.skilldetailsdata();
                parentID.find(".skillbodys").html(temp_data_basic);
            } catch (error) {
                console.log(error);
            }
        }
    }

    async selfedu() {
        let self = this;
        self.P_E_DB = await self.educationsavedetails();
        if (self.P_E_DB.status == "200") {
            self.P_E_DB = self.P_E_DB.data.details["0"];
        }
    }
    async personaldetailsdata() {
        let self = this;
        let personal_data_basic = "";
        try {
            personal_data_basic = await self.personaldetailsbasicdata();
        } catch (error) {
            console.log(error);
        }
        return `<div id="bodybasic" class="" >                     
                        ${personal_data_basic}                  
                </div>`;
    }
    // </div>
    async databasevalue(columnname) {
        let self = this;
        let datavalue = "";
        if (self.P_P_DB != "" && self.P_P_DB != undefined) {
            datavalue = self.P_P_DB;
            if (datavalue != "") {
                if (
                    datavalue[columnname] != null &&
                    datavalue[columnname] != undefined
                ) {
                    return datavalue[columnname];
                } else {
                    return "";
                }
            }
            return "";
        }
        return "";
    }
    async databaseeducationvalue(columnname) {
        let self = this;
        let datavalue = "";
        if (self.P_E_DB != "" && self.P_E_DB != undefined) {
            datavalue = self.P_E_DB;
            if (datavalue != "") {
                if (
                    datavalue[columnname] != null &&
                    datavalue[columnname] != undefined
                ) {
                    return datavalue[columnname];
                } else {
                    return "";
                }
            }
            return "";
        }
        return "";
    }

    async personaldetailsbasicdata() {
        let self = this;
        let family = await self.databasevalue("family_details");
        let trN = `<ul class="list-inline col-md-12">
        <li class="list-inline-item col-md-3"><b>Name</b></li>
        <li class="list-inline-item col-md-2"><b>Relation</b></li>
        <li class="list-inline-item col-md-2"><b>Age</b></li>
        <li class="list-inline-item col-md-2"><b>Education</b></li>
        <li class="list-inline-item col-md-2"><b>Occuption</b></li>
      </ul>`;

        if (family != "") {
            family = JSON.parse(family);
            $.each(family, function (key, value) {
                trN += `<ul class="list-inline col-md-12">
                    <li class="list-inline-item col-md-3">${value.name}</li>
                    <li class="list-inline-item col-md-2">${value.relationship}</li>
                    <li class="list-inline-item col-md-2">${value.age}</li>
                    <li class="list-inline-item col-md-2">${value.education}</li>
                    <li class="list-inline-item col-md-2">${value.occuption}</li>
                </ul>`;
            });
        }
        let language = await self.databasevalue("language_details");
        let lantr = `<ul class="list-inline col-xs-12 col-sm-12 col-md-12">
        <li class="list-inline-item col-xs-2 col-sm-2 col-md-2 "><b>Languages</b></li>
        <li class="list-inline-item col-xs-3 col-sm-3 col-md-3"><b>Proficiency</b></li>
        <li class="list-inline-item col-xs-2 col-sm-2 col-md-2"><b>Read</b></li>
        <li class="list-inline-item col-xs-2 col-sm-2 col-md-2"><b>Write</b></li>
        <li class="list-inline-item col-xs-2 col-sm-2col-md-2"><b>Speak</b></li>
      </ul>`;
        if (language != "") {
            language = JSON.parse(language);
            $.each(language, function (key, value) {
                lantr += `<ul class="list-inline col-md-12">
                <li class="list-inline-item col-xs-2 col-sm-2 col-md-2">${
                    value.inputtext
                }</li>
                <li class="list-inline-item col-xs-3 col-sm-3 col-md-3">${
                    value.inputselect
                }</li>
                <li class="list-inline-item col-xs-2 col-sm-2 col-md-2">${
                    value.inputread == "yes"
                        ? '<i class="fa fa-check" aria-hidden="true"></i>'
                        : '<i class="fa fa-times" aria-hidden="true"></i>'
                }</li>
                <li class="list-inline-item col-xs-2 col-sm-2 col-md-2">${
                    value.inputwrite == "yes"
                        ? '<i class="fa fa-check" aria-hidden="true"></i>'
                        : '<i class="fa fa-times" aria-hidden="true"></i>'
                }</li>
                <li class="list-inline-item col-xs-2 col-sm-2 col-md-2">${
                    value.inputspeak == "yes"
                        ? '<i class="fa fa-check" aria-hidden="true"></i>'
                        : '<i class="fa fa-times" aria-hidden="true"></i>'
                }</li>
            </ul>`;
            });
        }

        return ` <div class="row">
                ${await self.labelelement(
                    "Name",
                    "fa-user",
                    ["primary_head_class"],
                    ["output_class"],
                    (await self.databasevalue("firstname")) +
                        " " +
                        (await self.databasevalue("middlename")) +
                        " " +
                        (await self.databasevalue("middlename"))
                )}
                ${await self.labelelement(
                    "Date of Birth",
                    "fa fa-birthday-cake",
                    ["primary_head_class"],
                    ["output_class"],
                    await self.databasevalue("dob")
                )}
                ${await self.labelelement(
                    "Gender",
                    "fa fa-male",
                    ["primary_head_class"],
                    ["output_class"],
                    await self.databasevalue("gender")
                )}
                ${await self.labelelement(
                    "Bloodgroup",
                    "fa-medkit",
                    ["primary_head_class"],
                    ["output_class"],
                    await self.databasevalue("bloodgroup")
                )}
                ${await self.labelelement(
                    "Martial Status",
                    "fa-american-sign-language-interpreting",
                    ["primary_head_class"],
                    ["output_class"],
                    await self.databasevalue("martialstatus")
                )}
                ${await self.labelelement(
                    "Religion",
                    "fa-street-view",
                    ["primary_head_class"],
                    ["output_class"],
                    await self.databasevalue("religion")
                )}
                ${await self.labelelement(
                    "Email",
                    "fa-envelope",
                    ["primary_head_class"],
                    ["output_class"],
                    await self.databasevalue("email_id")
                )}
                ${await self.labelelement(
                    "Mobile",
                    "fa-mobile",
                    ["primary_head_class"],
                    ["output_class"],
                    await self.databasevalue("mobileno")
                )}
                ${await self.labelelement(
                    "Present Address",
                    "fa-address-book",
                    ["primary_head_class"],
                    ["output_class"],
                    `${await self.databasevalue(
                        "present_address"
                    )} ${await self.databasevalue(
                        "present_city"
                    )} ${await self.databasevalue(
                        "present_state"
                    )} ${await self.databasevalue("present_country")}`
                )}
                ${await self.labelelement(
                    "Permanent Address",
                    "fa-address-book",
                    ["primary_head_class"],
                    ["output_class"],
                    `${await self.databasevalue(
                        "permanent_address"
                    )} ${await self.databasevalue(
                        "permanent_city"
                    )} ${await self.databasevalue(
                        "permanent_state"
                    )} ${await self.databasevalue("permanent_country")}`
                )}
               
                ${await self.labelelement(
                    "Mother Tongue",
                    "fa-microphone",
                    ["primary_head_class"],
                    ["output_class"],
                    `${await self.databasevalue("mothertongue")}`
                )}                  
                   <div class="col-md-12">
                     <b> <i class="fa fa-language" aria-hidden="true"></i> Language Details</b> 
                    </div>
                   <div class="col-md-12">${lantr}</div>
                   <div class="col-md-12">
                   <b> <i class="fa fa-object-group" aria-hidden="true"></i> Family Details</b>
                 </div>
                <div class="col-md-12">
                    ${trN}
                </div>   
            </div>            
                `;
    }
    async educationdetailsdata() {
        let self = this;
        let sslc_det = await self.databaseeducationvalue("sslc_details");
        let sslc = "";

        if (sslc_det != "") {
            sslc_det = JSON.parse(sslc_det);
            let arraylabel = {
                Board: "sslcboard",
                "Passing Out": "passing_out",
                "School Medium": "sslcmedium",
                Marks: "sslcmarks",
            };
            for (var key in arraylabel) {
                sslc += await self.labelelement(
                    key,
                    "",
                    ["primary_head_class"],
                    ["output_class"],
                    self.valdateundefined(sslc_det[arraylabel[key]])
                );
            }
        }
        let hsc_det = await self.databaseeducationvalue("hsc_details");
        let HSC = ``;

        if (hsc_det != "") {
            hsc_det = JSON.parse(hsc_det);
            let arraylabel = {
                Board: "hscboard",
                "Passing Out": "hsc_passing_out",
                "School Medium": "hsc_medium",
                Marks: "hsc_marks",
            };
            for (var key in arraylabel) {
                HSC += await self.labelelement(
                    key,
                    "",
                    ["primary_head_class"],
                    ["output_class"],
                    self.valdateundefined(hsc_det[arraylabel[key]])
                );
            }
        }
        let ug_det = await self.databaseeducationvalue("graduation_details");
        let ug = ``;
        if (ug_det != "") {
            ug_det = JSON.parse(ug_det);
            if (ug_det != "") {
                let arraylabel = {
                    Course: "ugcourse",
                    University: "university",
                    Specilaization: "ugspecilaization",
                    Coursetype: "ugcoursetype",
                };

                for (let ugkey in ug_det) {
                    let ugloop = "";
                    let val = JSON.parse(ug_det[ugkey]);
                    let grading = "";
                    if (val.uggradingsystem == "Scale 10 Grading") {
                        grading = "10";
                    }
                    if (val.uggradingsystem == "Scale 4 Grading") {
                        grading = "5";
                    }
                    if (val.uggradingsystem == "Percentage of Marks(%)") {
                        grading = "100%";
                    }
                    if (val.uggradingsystem == "Course Requires a Pass") {
                        grading = "require Pass";
                    }
                    for (var key in arraylabel) {
                        ugloop += await self.labelelement(
                            key,
                            "",
                            ["primary_head_class"],
                            ["output_class"],
                            self.valdateundefined(val[arraylabel[key]]),
                            "col-2 col-md-2 col-xs-2 col-sm-2"
                        );
                    }
                    ugloop += await self.labelelement(
                        "Marks",
                        "",
                        ["primary_head_class"],
                        ["output_class"],
                        self.valdateundefined(val["ugmarks"]) + "/" + grading,
                        "col-3 col-md-3 col-xs-3 col-sm-3"
                    );
                    ug += ugloop;
                }
            }
        }
        let pg_det = await self.databaseeducationvalue("master_details");
        let PG = ``;
        if (pg_det != "") {
            pg_det = JSON.parse(pg_det);
            if (pg_det != "") {
                let arraylabel = {
                    Course: "pgcourse",
                    University: "pguniversity",
                    Specilaization: "pgspecilaization",
                    Coursetype: "pgcoursetype",
                };
                for (let ugkey in pg_det) {
                    let ugloop = "";
                    let val = JSON.parse(pg_det[ugkey]);
                    let grading = "";
                    if (val.pggradingsystem == "Scale 10 Grading") {
                        grading = "10";
                    }
                    if (val.pggradingsystem == "Scale 4 Grading") {
                        grading = "5";
                    }
                    if (val.pggradingsystem == "Percentage of Marks(%)") {
                        grading = "100%";
                    }
                    if (val.pggradingsystem == "Course Requires a Pass") {
                        grading = "require Pass";
                    }
                    for (var key in arraylabel) {
                        ugloop += await self.labelelement(
                            key,
                            "",
                            ["primary_head_class"],
                            ["output_class"],
                            self.valdateundefined(val[arraylabel[key]]),
                            "col-2 col-md-2 col-xs-2 col-sm-2"
                        );
                    }
                    ugloop += await self.labelelement(
                        "Marks",
                        "",
                        ["primary_head_class"],
                        ["output_class"],
                        self.valdateundefined(val["pgmarks"]) + "/" + grading,
                        "col-3 col-md-3 col-xs-3 col-sm-3"
                    );
                    PG += ugloop;
                }
            }
        }
        let doc_det = await self.databaseeducationvalue("doctorate_details");
        let Docot = ``;
        if (doc_det != "") {
            doc_det = JSON.parse(doc_det);
            // console.log(doc_det);
            if (doc_det != "") {
                let arraylabel = {
                    Course: "doctorate_course",
                    University: "docuniversity",
                    Specilaization: "doctorate_specilaization",
                    Coursetype: "doccoursetype",
                };
                for (let ugkey in doc_det) {
                    let ugloop = "";
                    let val = JSON.parse(doc_det[ugkey]);
                    let grading = "";
                    if (val.docgradingsystem == "Scale 10 Grading") {
                        grading = "10";
                    }
                    if (val.docgradingsystem == "Scale 4 Grading") {
                        grading = "5";
                    }
                    if (val.docgradingsystem == "Percentage of Marks(%)") {
                        grading = "100%";
                    }
                    if (val.docgradingsystem == "Course Requires a Pass") {
                        grading = "require Pass";
                    }
                    for (var key in arraylabel) {
                        ugloop += await self.labelelement(
                            key,
                            "",
                            ["primary_head_class"],
                            ["output_class"],
                            self.valdateundefined(val[arraylabel[key]]),
                            "col-2 col-md-2 col-xs-2 col-sm-2"
                        );
                    }
                    ugloop += await self.labelelement(
                        "Marks",
                        "",
                        ["primary_head_class"],
                        ["output_class"],
                        self.valdateundefined(val["docmarks"]) + "/" + grading,
                        "col-3 col-md-3 col-xs-3 col-sm-3"
                    );
                    Docot += ugloop;
                }
            }
        }

        return ` <div class="row">
                        <div class="col-md-12">S.S.L.C Details </div>
                            ${sslc}
                            <div class="col-md-12">H.S.C Details </div>   
                            ${HSC}
                            <div class="col-md-12">Graduation Details </div>   
                            ${ug}
                            <div class="col-md-12">PG Graduation Details </div>   
                            ${PG}
                            <div class="col-md-12">Doctorate Details </div> 
                            ${Docot}
                 </div>`;
    }
    async employmentdetailsdata() {
        let self = this;
        let employement_det = await self.databaseeducationvalue(
            "employment_details"
        );
        let employement = `<ul class="list-inline col-md-12">
        <li class="list-inline-item col-md-3"><b>Organization</b></li>
        <li class="list-inline-item col-md-2"><b>Designation</b></li>
        <li class="list-inline-item col-md-3"><b>Duration</b></li>
        <li class="list-inline-item col-md-3"><b>JobDescription</b></li>                
      </ul>`;

        if (employement_det != "") {
            employement_det = JSON.parse(employement_det);
            if (employement_det != "") {
                $.each(employement_det, function (key, value) {
                    let val = JSON.parse(value);
                    let salary = ``;
                    if (val.currentcompany_type == "Yes") {
                        salary += `${val.currentsalary_lacs} ${val.currentsalary_thousand}`;
                    }
                    employement += `<ul class="list-inline col-md-12">
                <li class="list-inline-item col-md-3" style="${
                    val.currentcompany_type == "Yes" ? "color:blue" : ""
                }">${val.currentcompany_type == "Yes" ? "*" : ""} ${
                        val.organization
                    }</li>
                <li class="list-inline-item col-md-2">${val.designation}</li>
                <li class="list-inline-item col-md-3">${val.workingfrom_year} ${
                        val.workingform_date
                    }-${val.till_year} ${val.till_month} </li>
                <li class="list-inline-item col-md-3">${
                    val.job_description
                }</li>                  
               </ul>`;
                });
            }
        }
        return ` <div class="row">
                        <div class="col-md-12"></div>
                            ${employement}                          
                 </div>`;
    }
    async skilldetailsdata() {
        let self = this;
        let skill_det = await self.databaseeducationvalue("skill_details");
        let skills = `<ul class="list-inline col-md-12">
        <li class="list-inline-item col-md-3"><b>Programme</b></li>
        <li class="list-inline-item col-md-3"><b>Organization Name</b></li>
        <li class="list-inline-item col-md-3"><b>Duration</b></li>                  
      </ul>`;

        if (skill_det != "") {
            skill_dets = JSON.parse(skill_det);
            if (skill_dets != "") {
                $.each(skill_dets, function (key, value) {
                    let val = JSON.parse(value);
                    skills += `<ul class="list-inline col-md-12">
                              <li class="list-inline-item col-md-3">${val.programme_value}</li>
                              <li class="list-inline-item col-md-3">${val.organization_name}</li>                              
                              <li class="list-inline-item col-md-3">${val.start_year} ${val.start_month}-${val.end_year} ${val.end_month} </li>                        
                        </ul>`;
                });
            }
        }
        return ` <div class="row">
                        <div class="col-md-12"></div>
                            ${skills}                          
                 </div>`;
    }
    async otherstemplateloading() {
        let self = this;
        let working_details = await self.databaseeducationvalue(
            "nash_working_details"
        );
        let parentID = $("#otherdetails_section");
        let imgdiv = `<div style="min-width:766px;min-height:214px;text-align:center;"><img style="margin-top:10%" src="${self.url}img/loader.gif") }}"></div>`;
        parentID.find(".otherbodys").html(imgdiv);
        console.log(working_details);
        // let skills = `<ul class="list-inline col-md-12">
        //     <li class="list-inline-item col-md-3"><b>Programme</b></li>
        //     <li class="list-inline-item col-md-3"><b>Organization Name</b></li>
        //     <li class="list-inline-item col-md-3"><b>Duration</b></li>
        //   </ul>`;

        // if (working_details != "") {
        //     workingDetails = JSON.parse(working_details);
        //     if (workingDetails != "") {
        //         $.each(workingDetails, function (key, value) {
        //             let val = JSON.parse(value);
        //             skills += `<ul class="list-inline col-md-12">
        //                           <li class="list-inline-item col-md-3">${val.programme_value}</li>
        //                           <li class="list-inline-item col-md-3">${val.organization_name}</li>
        //                           <li class="list-inline-item col-md-3">${val.start_year} ${val.start_month}-${val.end_year} ${val.end_month} </li>
        //                     </ul>`;
        //         });
        //     }
        // }
    }

    defaultmethod() {
        let self = this;
        $("input").attr("autocomplete", "off");
        $(".quicklink>ul>li").click(function (e) {
            e.preventDefault();
            let idscroll = $(this).attr("id");
            $("html, body").animate(
                {
                    scrollTop: $(`#${idscroll}_section`).offset().top - 257,
                },
                1000
            );
        });
        $("body").on("click", ".modalclose", async function (e) {
            e.preventDefault();
            let modelcloseid = $(this).attr("id");
            $("#persModal").modal("hide");
            if (modelcloseid == "personalclose") {
                await self.templatebodyloading();
            } else if (modelcloseid == "educationclose") {
                await self.educationtemplateloading();
            } else if (modelcloseid == "employeeclose") {
                await self.employementtemplateloading();
            } else if (modelcloseid == "skillclose") {
                await self.skilltemplateloading();
            } else if (modelcloseid == "otherclose") {
                await self.otherstemplateloading();
            } else {
                window.location.reload();
            }
        });

        $("#personal_modal_edit").on("click", async function (e) {
            e.preventDefault();
            let imgdiv = `<div style="min-width:766px;min-height:214px;text-align:center;"><img style="margin-top:10%" src="${self.url}img/loader.gif") }}"></div>`;
            $(".modal-body").html(imgdiv);
            $(".modal-title").html("Personal Details");
            $(".modalclose").attr("id", "personalclose");
            $("#persModal").modal("show");
            let div = await self.personaldetails();
            $(".modal-body").html(div);
            self.activaTab("basic");
            self.datepickers();
            $("input").attr("autocomplete", "off");
            await self.triggervalue();
            await self.triggerfilevalue("personal");
        });
        $("body").on("click", "#education_modal_edit", async function (e) {
            e.preventDefault();
            let imgdiv = `<div style="min-width:766px;min-height:214px;text-align:center;"><img style="margin-top:10%" src="${self.url}img/loader.gif") }}"></div>`;
            $(".modal-body").html(imgdiv);
            $(".modal-title").html("Education Details");
            $(".modalclose").attr("id", "educationclose");
            $("#persModal").modal("show");
            await self.selfedu();
            let div = await self.educationdetails();
            $(".modal-body").html(div);
            self.activaTab("basic");
            $("input").attr("autocomplete", "off");
            await self.edutriggervalue();
            await self.triggerfilevalue("education");
        });
        $("body").on("click", "#employment_modal_edit", async function (e) {
            e.preventDefault();
            //console.log(self.url);
            let imgdiv = `<div style="min-width:766px;min-height:214px;text-align:center;"><img style="margin-top:10%" src="${self.url}img/loader.gif") }}"></div>`;
            $(".modal-body").html(imgdiv);
            $(".modal-title").html("Employment Details");
            $(".modalclose").attr("id", "employeeclose");
            $("#persModal").modal("show");
            let div = await self.employmentdetails();
            $(".modal-body").html(div);
            self.activaTab("basic");
            $("input").attr("autocomplete", "off");
            await self.employmenttriggervalue();
        });
        $("body").on("click", "#skill_modal_edit", async function (e) {
            e.preventDefault();
            //console.log(self.url);
            let imgdiv = `<div style="min-width:766px;min-height:214px;text-align:center;"><img style="margin-top:10%" src="${self.url}img/loader.gif") }}"></div>`;
            $(".modal-body").html(imgdiv);
            $(".modal-title").html("Skill Details");
            $(".modalclose").attr("id", "skillclose");
            $("#persModal").modal("show");
            let div = await self.skilldetails();
            $(".modal-body").html(div);
            self.activaTab("basic");
            $("input").attr("autocomplete", "off");
            await self.skilltriggervalue();
        });
        $("body").on("click", "#other_modal_edit", async function (e) {
            e.preventDefault();
            //console.log(self.url);
            let imgdiv = `<div style="min-width:766px;min-height:214px;text-align:center;"><img style="margin-top:10%" src="${self.url}img/loader.gif") }}"></div>`;
            $(".modal-body").html(imgdiv);
            $(".modal-title").html("Other Details");
            $(".modalclose").attr("id", "otherclose");
            $("#persModal").modal("show");
            let div = await self.otherdetails();
            $(".modal-body").html(div);
            self.activaTab("basic");
            $("input").attr("autocomplete", "off");
            await self.triggerotherdetails();
        });

        $("body").on("click", ".plusevent", function (e) {
            e.preventDefault();
            var div = self.GetDynamicTextBox();
            $("#TextBoxContainer").append(div);
        });
        $("body").on("click", ".removeevent", function () {
            $(this).closest("tr").remove();
        });
        $("body").on("change", "#martialstatus", function () {
            let thisvalue = $(this).val();
            if (thisvalue == "Married") {
                let div = self.anniversarydate();
                $("#anniversary_date").html(div);
                self.datepickers();
            } else {
                $("#anniversary_date").html("");
            }
        });
        $("body").on(
            "change",
            'input:radio[name="differently_type"]',
            function () {
                if ($(this).is(":checked") && $(this).val() == "Yes") {
                    let inputdiv = self.differently_abled_type();
                    let selectdiv = self.differntalyable();
                    $("#differently_abled").html(selectdiv);
                    $("#differently_abled_type_html").html(inputdiv);
                } else {
                    $("#differently_abled").html("");
                    $("#differently_abled_type_html").html("");
                }
            }
        );
        $("body").on(
            "change",
            'input:checkbox[name="same_as_above"]',
            function () {
                if ($(this).is(":checked")) {
                    let permanent_country = $("#present_country").html();
                    let permanent_state = $("#present_state").html();
                    let permanent_city = $("#present_city").html();
                    let permanent_address = $("#present_address").val();
                    let permanent_pincode = $("#present_pincode").val();
                    $("#permanent_country").html(permanent_country);
                    $("#permanent_state").html(permanent_state);
                    $("#permanent_city").html(permanent_city);
                    $("#permanent_address").val(permanent_address);
                    $("#permanent_pincode").val(permanent_pincode);
                    $("#permanent_country").val($("#present_country").val());
                    $("#permanent_state").val($("#present_state").val());
                    $("#permanent_city").val($("#present_city").val());
                } else {
                    let permanent_country = $("#present_country").html();
                    let permanent_state = $("#present_state").html();
                    let permanent_city = $("#present_city").html();
                    $("#permanent_country").html(permanent_country);
                    $("#permanent_state").html(permanent_state);
                    $("#permanent_city").html(permanent_city);
                    $("#permanent_address").val("");
                    $("#permanent_pincode").val("");
                }
            }
        );
        $("body").on(
            "change",
            'input:radio[name="previous_employee"]',
            function () {
                if ($(this).is(":checked") && $(this).val() == "Yes") {
                    $(this).closest(".row").find("textarea").show();
                } else {
                    $(this).closest(".row").find("textarea").hide();
                }
            }
        );
        $("body").on(
            "change",
            'input:radio[name="any_court_law"]',
            function () {
                if ($(this).is(":checked") && $(this).val() == "Yes") {
                    $(this).closest(".row").find("textarea").show();
                } else {
                    $(this).closest(".row").find("textarea").hide();
                }
            }
        );
        $("body").on(
            "change",
            'input:radio[name="major_illness"]',
            function () {
                if ($(this).is(":checked") && $(this).val() == "Yes") {
                    $(this).closest(".row").find("textarea").show();
                } else {
                    $(this).closest(".row").find("textarea").hide();
                }
            }
        );
        $("body").on(
            "change",
            'input:radio[name="relative_working"]',
            function () {
                if ($(this).is(":checked") && $(this).val() == "Yes") {
                    $(this).closest(".row").find("textarea").show();
                } else {
                    $(this).closest(".row").find("textarea").hide();
                }
            }
        );

        $("body").on(
            "change",
            'input:radio[name="currentcompany_type"]',
            function () {
                if ($(this).is(":checked") && $(this).val() == "Yes") {
                    $("#currentsalary").show();
                } else {
                    $("#currentsalary").hide();
                }
            }
        );

        /** Modal Action Event */
        $("body").on("change", "#ugcourse", function () {
            let thisvalue = $(this).val();
            let ugcoursedetails = `<option value="">Select Specilaization</option>`;
            $.each(self.globaldata.data[0]["ugcoursedetails"][0], function (
                key,
                value
            ) {
                if (key == thisvalue) {
                    $.each(value, function (key, val) {
                        ugcoursedetails += `<option value=${val}>${val}</option>`;
                    });
                }
            });
            $("#graduation").find(".file_details").html("");
            $("#ugspecilaization").html(ugcoursedetails);
        });
        $("body").on("change", "#pgcourse", function () {
            //specilaization//ugcoursedetails
            let thisvalue = $(this).val();
            let pgcoursedetails = `<option value="">Select Specilaization</option>`;
            $.each(self.globaldata.data[0]["pgcoursedetails"][0], function (
                key,
                value
            ) {
                if (key == thisvalue) {
                    $.each(value, function (key, val) {
                        pgcoursedetails += `<option value=${val}>${val}</option>`;
                    });
                }
            });
            $("#master").find(".file_details").html("");
            $("#pgspecilaization").html(pgcoursedetails);
        });
        $("body").on("change", "#doctorate_course", function () {
            let thisvalue = $(this).val();
            let doctratedetails = `<option value="">Select Specilaization</option>`;
            $.each(self.globaldata.data[0]["doctratedetails"], function (
                key,
                value
            ) {
                doctratedetails += `<option value=${value}>${value}</option>`;
            });
            $("#doctor").find(".file_details").html("");
            $("#doctorate_specilaization").html(doctratedetails);
        });
        $("body").on("change", ".fu", function (e) {
            var fileName = e.target.files[0].name;
            $("#spanfilename").html(fileName);
        });
        $("body").on("click", "#add_language", async function (e) {
            e.preventDefault();
            let add_filename = $(this).parent("div").find("input");
            if (add_filename.val() != "") {
                let temp_id = self.tempid_details(add_filename.val());
                let languagehtml = await self.languagetemplate(
                    add_filename.val(),
                    temp_id,
                    "remove"
                );
                $("#languagehtml").append(languagehtml);
                $(this).parent("div").find("input").val("");
            } else {
                add_filename.focus();
            }
        });
        $("body").on("click", ".deletebtn", function (e) {
            e.preventDefault();
            let parentid = $(this).closest(".tab-pane").attr("id");
            $(`#${parentid}`).find("#success").html("");
            $(this).removeClass("btn btn-primary deletebtn");
            $(this).addClass("btn btn-warning removeconfirm");
            $(`#${parentid}`)
                .find("#success")
                .html(`Click again for delete confirmation`);
        });
        $("body").on("click", ".removeconfirm", async function (e) {
            e.preventDefault();
            let parentid = $(this).closest(".tab-pane").attr("id");
            let deleteid = $(this).data("deletebtn");
            let filename = $(this).closest("tr").find(".filenames").val();

            let filebase = $(this)
                .closest("tr")
                .find(".savedetails")
                .data("ids");
            let temp_empid = self.P_B_DB.id;
            let deletestatus = await self.deletefiles(deleteid, temp_empid);
            let addbtn = "";
            if (filebase == "education") {
                addbtn = "addbtn";
            }
            let basename = $(this)
                .closest("tr")
                .find(".filenames")
                .data("basename");
            if (deletestatus.status == 200) {
                let regen = $(this).data("regen");
                if (regen == "yes") {
                    let la_tr = self.fileuploadhtml(
                        basename,
                        filename,
                        "",
                        filebase,
                        "removebtn",
                        "",
                        "regen",
                        "",
                        "",
                        addbtn,
                        ""
                    );
                    $(this).closest(".file_details").append(la_tr);
                    $(this).closest("tr").remove();
                    $(`#${parentid}`)
                        .find("#success")
                        .html(`File Successfully Deleted`);
                } else {
                    $(this).closest("tr").remove();
                    $(`#${parentid}`)
                        .find("#success")
                        .html(`File Successfully Deleted`);
                }
            }
        });
        $("body").on("click", ".confirmbtn", async function (e) {
            e.preventDefault();
            let parentid = $(this).closest(".tab-pane").attr("id");
            $(`#${parentid}`).find("#success").html("");
            $(this).removeClass("btn btn-primary confirmbtn");
            $(this).addClass("btn btn-warning verifiedbtn");
            $(`#${parentid}`)
                .find("#success")
                .html(`Click again for Verfied button`);
        });
        $("body").on("click", ".verifiedbtn", async function (e) {
            e.preventDefault();
            let parentid = $(this).closest(".tab-pane").attr("id");
            let confirmid = $(this).data("confirmid");
            let temp_empid = self.P_B_DB.id;
            let verifiedstatus = await self.verifiedfiles(
                confirmid,
                temp_empid
            );
            if (verifiedstatus.status == 200) {
                $(`#${parentid}`)
                    .find("#success")
                    .html(`Verified Success updated`);
                $(this).closest("td").find("span").text("Verified");
            }
        });

        $("body").on("click", ".add_files", async function (e) {
            let add_filename = $(this).parent("div").find("input");
            if (add_filename.val() != "") {
                let temp_id = self.tempid_details(add_filename.val());
                let filebase = $(this).data("filebase");
                let fileuploadhtmls = self.fileuploadhtml(
                    "Other",
                    add_filename.val(),
                    "",
                    filebase,
                    "yes",
                    "",
                    "",
                    "",
                    "",
                    "",
                    ""
                );
                $("#bodyfiles").find(".file_details").append(fileuploadhtmls);
                $(this).parent("div").find("input").val("");
            } else {
                add_filename.focus();
            }
        });
        $("body").on("change", "#present_country", async function (e) {
            e.preventDefault();
            let thisvalue = $(this).val();
            let statelist = await self.joiningstatelist(thisvalue);
            let state = $(this).data("state");
            //console.log(statelist);
            if (statelist.status == 200) {
                if (
                    statelist.data.state != undefined &&
                    statelist.data.state != null
                ) {
                    let countrystatelist = `<option>Select State</option>`;
                    $.each(statelist.data.state, function (key, value) {
                        countrystatelist += `<option ${
                            state != "" && state == value.id ? "selected" : ""
                        } value=${value.id} >${value.state_name}</option>`;
                    });
                    $("#present_state").html(countrystatelist);
                }
            }
        });
        $("body").on("change", "#present_state", async function (e) {
            e.preventDefault();
            let thisvalue = $(this).val();

            let citylist = await self.joiningcitylist(thisvalue);
            let city = $(this).data("city");
            if (citylist.status == 200) {
                if (
                    citylist.data.city != undefined &&
                    citylist.data.city != null
                ) {
                    let statecitylist = `<option>Select City</option>`;
                    $.each(citylist.data.city, function (key, value) {
                        statecitylist += `<option ${
                            city != "" && city == value.id ? "selected" : ""
                        } value=${value.id}>${value.city_name}</option>`;
                    });
                    $("#present_city").html(statecitylist);
                    if (city != "") {
                        $("#present_city").val(city);
                    }
                }
            }
        });
        $("body").on("change", "#permanent_country", async function (e) {
            e.preventDefault();
            let thisvalue = $(this).val();
            let statelist = await self.joiningstatelist(thisvalue);
            //console.log(statelist);
            if (statelist.status == 200) {
                if (
                    statelist.data.state != undefined &&
                    statelist.data.state != null
                ) {
                    let citylist = `<option>Select State</option>`;
                    $.each(statelist.data.state, function (key, value) {
                        citylist += `<option value=${value.id}>${value.state_name}</option>`;
                    });
                    $("#permanent_state").html(citylist);
                }
            }
        });
        $("body").on("change", "#permanent_state", async function (e) {
            e.preventDefault();
            let thisvalue = $(this).val();
            let citylist = await self.joiningcitylist(thisvalue);
            if (citylist.status == 200) {
                if (
                    citylist.data.city != undefined &&
                    citylist.data.city != null
                ) {
                    let statecitylist = `<option>Select City</option>`;
                    $.each(citylist.data.city, function (key, value) {
                        statecitylist += `<option value=${value.id}>${value.city_name}</option>`;
                    });
                    $("#permanent_city").html(statecitylist);
                }
            }
        });

        /** End Modal Action Event */

        /**Personal Save */

        $("body").on("click", "#personal_basic", async function (e) {
            let parentid = $("#basic");
            parentid.find("#error").html("");
            parentid.find("#success").html("");
            let idelement = [
                { id: "firstname", label: "First Name", required: 1 },
                { id: "middlename", label: "Middle Name", required: 0 },
                { id: "lastname", label: "Last Name", required: 0 },
                { id: "dob", label: "Date of Birth", required: 1 },
                { id: "gender", label: "Gender", required: 1 },
                { id: "bloodgroup", label: "Blood Group", required: 1 },
                { id: "martialstatus", label: "Martial Status", required: 1 },
                { id: "religion", label: "Religion", required: 1 },
            ];
            let process = 0;
            let data = {};
            $.each(idelement, function (key, value) {
                if (
                    parentid.find(`#${value.id}`).val() == "" &&
                    value.required == 1
                ) {
                    process = 0;
                    return self.errormethod(
                        "basic",
                        value.id,
                        `Please Check the ${value.label}`
                    );
                } else {
                    process = 1;
                    data[value.id] = parentid.find(`#${value.id}`).val();
                }
            });
            if (process == 1) {
                data.differently_abled = $(
                    'input:radio[name="differently_type"]'
                ).val();
                if (data.differently_abled == "Yes") {
                    data.differently_abled_type = parentid
                        .find("#differently_abled_type")
                        .val();
                    data.differently_assistance = parentid
                        .find("#differently_assistance")
                        .val();
                }
                if (data.martialstatus == "Married") {
                    data.anniversary_date = parentid
                        .find("#anniversarydate")
                        .val();
                }
                data.temp_empid = self.P_B_DB.id;
                let savepersonal = await self.personalBasicsave(data);
                if (savepersonal.status == "200") {
                    self.successmethod(
                        "basic",
                        "Basic Details Successfully Added"
                    );
                }
            }
        });
        /**End Personal Save */
        /**ContactSave */
        $("body").on("click", "#personal_contact", async function (e) {
            let parentid = $("#contact");
            parentid.find("#error").html("");
            parentid.find("#success").html("");
            let idelement = [
                { id: "email_id", label: "Email", required: 1 },
                { id: "mobileno", label: "Mobile No", required: 1 },
                { id: "landlineno", label: "Land Line No", required: 0 },
                {
                    id: "alternate_mobile",
                    label: "Alternate Mobile No",
                    required: 0,
                },
            ];
            let process = 0;
            let data = {};
            $.each(idelement, function (key, value) {
                if (
                    parentid.find(`#${value.id}`).val() == "" &&
                    value.required == 1
                ) {
                    process = 0;
                    return self.errormethod(
                        "contact",
                        value.id,
                        `Please Check the ${value.label}`
                    );
                } else {
                    process = 1;
                    data[value.id] = parentid.find(`#${value.id}`).val();
                }
            });
            if (process == 1) {
                data.temp_empid = self.P_B_DB.id;
                let savepersonal = await self.personalBasicsave(data);
                if (savepersonal.status == "200") {
                    self.successmethod(
                        "contact",
                        "Contact Details Successfully Added"
                    );
                }
            }
        });
        /**EndContactSave */
        /**Address Details */
        $("body").on("click", "#personal_address", async function (e) {
            let parentid = $("#Address");
            parentid.find("#error").html("");
            parentid.find("#success").html("");
            let idelement = [
                { id: "present_address", label: "Present Street", required: 1 },
                {
                    id: "present_country",
                    label: "Present Country",
                    required: 1,
                },
                { id: "present_state", label: "Present State", required: 1 },
                { id: "present_city", label: "Present City", required: 1 },
                {
                    id: "present_pincode",
                    label: "Present Pincode",
                    required: 1,
                },
                {
                    id: "permanent_address",
                    label: "Permanent Street",
                    required: 1,
                },
                {
                    id: "permanent_country",
                    label: "Permanent Country",
                    required: 1,
                },
                {
                    id: "permanent_state",
                    label: "Permanent State",
                    required: 1,
                },
                { id: "permanent_city", label: "Permanent City", required: 1 },
                {
                    id: "permanent_pincode",
                    label: "Permanent Pincode",
                    required: 1,
                },
            ];
            let process = 0;
            let data = {};
            $.each(idelement, function (key, value) {
                if (
                    parentid.find(`#${value.id}`).val() == "" &&
                    value.required == 1
                ) {
                    process = 0;
                    return self.errormethod(
                        "Address",
                        value.id,
                        `Please Check the ${value.label}`
                    );
                } else {
                    process = 1;
                    data[value.id] = parentid.find(`#${value.id}`).val();
                }
            });
            // console.log(data);
            if (process == 1) {
                data.temp_empid = self.P_B_DB.id;
                let savepersonal = await self.personalBasicsave(data);
                if (savepersonal.status == "200") {
                    self.successmethod(
                        "Address",
                        "Address Details Successfully Added"
                    );
                }
            }
        });

        /**End Address Details */

        /**FamilyDetails */

        $("body").on("click", "#personal_family", async function () {
            let parentid = $("#Family");
            parentid.find("#error").html("");
            parentid.find("#success").html("");
            let process = [];
            $("#TextBoxContainer > tr").each(function (index, tr) {
                let temp = {};
                temp.name = $(this).find(".names").val();
                temp.relationship = $(this).find(".relationship").val();
                temp.age = $(this).find(".age").val();
                temp.education = $(this).find(".education").val();
                temp.occuption = $(this).find(".occuption").val();
                if (temp.name != "" && temp.name != null) {
                    process.push(temp);
                } else {
                    $(this).find(".names").focus();
                    process = [];
                }
            });
            let data = {};
            if (process.length > 0) {
                data.temp_empid = self.P_B_DB.id;
                data.total_family_members = process.length;
                data.family_details = JSON.stringify(process);
                let savepersonal = await self.personalBasicsave(data);
                if (savepersonal.status == "200") {
                    self.successmethod(
                        "Family",
                        "Family Details Successfully Added"
                    );
                }
            }
        });

        /**End Family */
        $("body").on("click", "#personal_language", async function () {
            let parentid = $("#languages");
            parentid.find("#error").html("");
            parentid.find("#success").html("");
            let process = [];
            let mothertongue = "";
            $("#languagehtml > .row").each(function (key, val) {
                let language_id = $(this).attr("id");
                if (language_id != undefined) {
                    if (language_id == "add_mothertongue") {
                        mothertongue = $(".inputtext").val();
                    }
                    let temp = {};
                    temp.rowid = language_id;
                    temp.inputtext = $(this).find(".inputtext").val();
                    temp.inputselect = $(this).find(".inputselect").val();

                    temp.inputread = $(this).find(".inputread").is(":checked")
                        ? "yes"
                        : "no";
                    temp.inputwrite = $(this).find(".inputwrite").is(":checked")
                        ? "yes"
                        : "no";
                    temp.inputspeak = $(this).find(".inputspeak").is(":checked")
                        ? "yes"
                        : "no";
                    if (temp.inputtext == "" || temp.inputtext == null) {
                        self.errormethod(
                            "languages",
                            "error",
                            "Please Check the Language Name"
                        );
                        $(this).find(".inputtext").focus();
                        process = [];
                        return false;
                    } else if (
                        temp.inputread == "no" &&
                        temp.inputwrite == "no" &&
                        temp.inputspeak == "no"
                    ) {
                        self.errormethod(
                            "languages",
                            "error",
                            "Please Choose the Proficiency Details"
                        );
                        $(this).find(".inputtext").focus();
                        process = [];
                        return false;
                    } else {
                        process.push(temp);
                    }
                }
            });
            let data = {};
            if (process.length > 0) {
                data.temp_empid = self.P_B_DB.id;
                data.mothertongue = mothertongue;
                data.total_language = process.length;
                data.language_details = JSON.stringify(process);
                let savepersonal = await self.personalBasicsave(data);
                if (savepersonal.status == "200") {
                    self.successmethod(
                        "languages",
                        "Language Details Successfully Added"
                    );
                }
            }
        });
        $("body").on("click", ".savedetails", async function () {
            //let parentid = $("#files");
            let parentid = $(this).closest(".tab-pane").attr("id");

            $(`#${parentid}`).find("#error").html("");
            $(`#${parentid}`).find("#success").html("");
            let formData = new FormData();
            let file = $(this).closest("tr").find("input[type=file]")[0]
                .files[0];
            let filedescription = $(this)
                .closest("tr")
                .find(".filedescription")
                .val();
            let basename = $(this)
                .closest("tr")
                .find(".filenames")
                .data("basename");
            if (file != undefined && filedescription != "") {
                let filename = $(this).closest("tr").find(".filenames").val();
                let removebtn =
                    $(this).closest("tr").find(".removebtn").data("regen") ==
                    "regen"
                        ? "no"
                        : "yes";
                let base = $(this).data("ids");
                formData.append("basename", basename);
                formData.append("temp_empid", self.P_B_DB.id);
                formData.append("file_description", filedescription);
                formData.append("filename", filename);
                formData.append("file", file, file.name);
                formData.append("removebtn", removebtn);
                formData.append("file_base_path", base);
                let savefiles = await self.filedetailsstored(formData);
                //console.log(savefiles);
                if (savefiles.status == "200") {
                    self.successmethod(
                        parentid,
                        "Files Details Successfully Added"
                    );
                    if (
                        parentid == "graduation" ||
                        parentid == "master" ||
                        parentid == "doctor" ||
                        base == "previousemployee"
                    ) {
                        await self.clicktriggerfile(base, filename, basename);
                    } else {
                        await self.triggerfilevalue(base);
                    }

                    // let downloadtd = `<td><a href="${self.url}storage/HrFiles/${savefiles.data.filepath}" download>
                    // <i class="fa fa-download" aria-hidden="true"></i></td>`;
                    // $(this).closest("tr").append(downloadtd);
                }
            } else {
                $(this).closest("tr").find(".filenames").focus();
                $(this).closest("tr").find(".filedescription").focus();
            }
        });
        $("body").on("click", ".removebtn", async function () {
            let regen = $(this).data("regen");
            if (regen == "regen") {
                //$(this).closest("tr").find(".filedescription").val("");
                $(this).closest("tr").find(".file-upload-field").val("");
            } else {
                $(this).closest("tr").remove();
            }
        });
        $("body").on("click", "#education_ssc", async function () {
            let parentid = $("#basic");
            parentid.find("#error").html("");
            parentid.find("#success").html("");
            let idelement = [
                { id: "sslcboard", label: "Board", required: 1 },
                { id: "passing_out", label: "Passing Out Year", required: 1 },
                { id: "sslcmedium", label: "School Medium", required: 1 },
                { id: "sslcmarks", label: "Total Marks", required: 1 },
            ];
            let process = 0;
            let data = {};
            $.each(idelement, function (key, value) {
                if (
                    parentid.find(`#${value.id}`).val() == "" &&
                    value.required == 1
                ) {
                    process = 0;
                    return self.errormethod(
                        "basic",
                        value.id,
                        `Please Check the ${value.label}`
                    );
                } else {
                    process = 1;
                    data[value.id] = parentid.find(`#${value.id}`).val();
                }
            });
            if (process == 1) {
                let storeval = {};
                storeval.temp_empid = self.P_B_DB.id;
                storeval.sslc_details = JSON.stringify(data);
                let savepersonal = await self.educationsave(storeval);
                if (savepersonal.status == "200") {
                    self.successmethod(
                        "basic",
                        "Basic Details Successfully Added"
                    );
                }
            }
        });

        $("body").on("click", "#education_hsc", async function () {
            let parentid = $("#hsc");
            parentid.find("#error").html("");
            parentid.find("#success").html("");
            let idelement = [
                { id: "hscboard", label: "Board", required: 1 },
                {
                    id: "hsc_passing_out",
                    label: "Passing Out Year",
                    required: 1,
                },
                { id: "hsc_medium", label: "School Medium", required: 1 },
                { id: "hsc_marks", label: "Total Marks", required: 1 },
            ];
            let process = 0;
            let data = {};
            $.each(idelement, function (key, value) {
                if (
                    parentid.find(`#${value.id}`).val() == "" &&
                    value.required == 1
                ) {
                    process = 0;
                    return self.errormethod(
                        "hsc",
                        value.id,
                        `Please Check the ${value.label}`
                    );
                } else {
                    process = 1;
                    data[value.id] = parentid.find(`#${value.id}`).val();
                }
            });
            if (process == 1) {
                let storeval = {};
                storeval.temp_empid = self.P_B_DB.id;
                storeval.hsc_details = JSON.stringify(data);
                let savepersonal = await self.educationsave(storeval);
                if (savepersonal.status == "200") {
                    self.successmethod(
                        "hsc",
                        "H.S.C Details Successfully Added"
                    );
                }
            }
        });
        $("body").on("click", "#education_graduation", async function () {
            let parentid = $("#graduation");
            parentid.find("#error").html("");
            parentid.find("#success").html("");
            let idelement = [
                { id: "ugcourse", label: "Course", required: 1 },
                {
                    id: "university",
                    label: "University/Institute",
                    required: 1,
                },
                {
                    id: "ugspecilaization",
                    label: "Specilaization",
                    required: 1,
                },
                {
                    id: "uggradingsystem",
                    label: "Grading System",
                    required: 1,
                },
                { id: "ugmarks", label: "Marks", required: 1 },
            ];
            let process = 0;
            let data = {};
            $.each(idelement, function (key, value) {
                if (
                    parentid.find(`#${value.id}`).val() == "" &&
                    value.required == 1
                ) {
                    process = 0;
                    return self.errormethod(
                        "graduation",
                        value.id,
                        `Please Check the ${value.label}`
                    );
                } else {
                    process = 1;
                    data[value.id] = parentid.find(`#${value.id}`).val();
                }
            });
            if (process == 1) {
                data.coursetype = $("input[name='ugcoursetype']:checked").val();
                let compain_graducation = await self.databaseeducationvalue(
                    "graduation_details"
                );
                if (compain_graducation != "") {
                    compain_graducation = JSON.parse(compain_graducation);
                    compain_graducation[data.ugcourse] = JSON.stringify(data);
                } else {
                    compain_graducation = {};
                    compain_graducation[data.ugcourse] = JSON.stringify(data);
                }

                let storeval = {};
                storeval.temp_empid = self.P_B_DB.id;
                storeval.graduation_details = JSON.stringify(
                    compain_graducation
                );
                // console.log(storeval);
                let savepersonal = await self.educationsave(storeval);
                if (savepersonal.status == "200") {
                    self.successmethod(
                        "graduation",
                        "Graduation Details Successfully Added"
                    );
                    $.each(idelement, function (key, value) {
                        parentid.find(`#${value.id}`).val("");
                    });
                    await self.selfedu();
                    await self.edutriggervalue();
                }
            }
        });
        $("body").on("click", "#education_master", async function () {
            let parentid = $("#master");
            parentid.find("#error").html("");
            parentid.find("#success").html("");
            let idelement = [
                { id: "pgcourse", label: "Course", required: 1 },
                {
                    id: "pguniversity",
                    label: "University/Institute",
                    required: 1,
                },
                {
                    id: "pgspecilaization",
                    label: "Specilaization",
                    required: 1,
                },
                {
                    id: "pggradingsystem",
                    label: "Grading System",
                    required: 1,
                },
                { id: "pgmarks", label: "Marks", required: 1 },
            ];
            let process = 0;
            let data = {};
            $.each(idelement, function (key, value) {
                if (
                    parentid.find(`#${value.id}`).val() == "" &&
                    value.required == 1
                ) {
                    process = 0;
                    return self.errormethod(
                        "master",
                        value.id,
                        `Please Check the ${value.label}`
                    );
                } else {
                    process = 1;
                    data[value.id] = parentid.find(`#${value.id}`).val();
                }
            });
            if (process == 1) {
                data.coursetype = $("input[name='pgcoursetype']:checked").val();
                let compain_graducation = await self.databaseeducationvalue(
                    "master_details"
                );
                if (compain_graducation != "") {
                    compain_graducation = JSON.parse(compain_graducation);
                    compain_graducation[data.pgcourse] = JSON.stringify(data);
                } else {
                    compain_graducation = {};
                    compain_graducation[data.pgcourse] = JSON.stringify(data);
                }

                let storeval = {};
                storeval.temp_empid = self.P_B_DB.id;
                storeval.master_details = JSON.stringify(compain_graducation);
                // console.log(storeval);
                let savepersonal = await self.educationsave(storeval);
                if (savepersonal.status == "200") {
                    self.successmethod(
                        "master",
                        "PG Graduation Details Successfully Added"
                    );
                    $.each(idelement, function (key, value) {
                        parentid.find(`#${value.id}`).val("");
                    });
                    await self.selfedu();
                    await self.edutriggervalue();
                }
            }
        });
        $("body").on("click", "#education_doctorate", async function () {
            let parentid = $("#doctor");
            parentid.find("#error").html("");
            parentid.find("#success").html("");
            let idelement = [
                { id: "doctorate_course", label: "Course", required: 1 },
                {
                    id: "docuniversity",
                    label: "University/Institute",
                    required: 1,
                },
                {
                    id: "doctorate_specilaization",
                    label: "Specilaization",
                    required: 1,
                },
                {
                    id: "docgradingsystem",
                    label: "Grading System",
                    required: 1,
                },
                { id: "docmarks", label: "Marks", required: 1 },
            ];
            let process = 0;
            let data = {};
            $.each(idelement, function (key, value) {
                if (
                    parentid.find(`#${value.id}`).val() == "" &&
                    value.required == 1
                ) {
                    process = 0;
                    return self.errormethod(
                        "doctor",
                        value.id,
                        `Please Check the ${value.label}`
                    );
                } else {
                    process = 1;
                    data[value.id] = parentid.find(`#${value.id}`).val();
                }
            });
            if (process == 1) {
                data.coursetype = $(
                    "input[name='doccoursetype']:checked"
                ).val();
                let compain_graducation = await self.databaseeducationvalue(
                    "doctorate_details"
                );
                if (compain_graducation != "") {
                    compain_graducation = JSON.parse(compain_graducation);
                    compain_graducation[data.doctorate_course] = JSON.stringify(
                        data
                    );
                } else {
                    compain_graducation = {};
                    compain_graducation[data.doctorate_course] = JSON.stringify(
                        data
                    );
                }

                let storeval = {};
                storeval.temp_empid = self.P_B_DB.id;
                storeval.doctorate_details = JSON.stringify(
                    compain_graducation
                );
                // console.log(storeval);
                let savepersonal = await self.educationsave(storeval);
                if (savepersonal.status == "200") {
                    self.successmethod(
                        "doctor",
                        "Doctorate Details Successfully Added"
                    );
                    $.each(idelement, function (key, value) {
                        parentid.find(`#${value.id}`).val("");
                    });
                    await self.selfedu();
                    await self.edutriggervalue();
                }
            }
        });
        $("body").on("click", "#employment_save", async function () {
            let parentid = $("#basic");
            parentid.find("#error").html("");
            parentid.find("#success").html("");
            let idelement = [
                { id: "organization", label: "Organization", required: 1 },
                {
                    id: "designation",
                    label: "Designation",
                    required: 1,
                },
                {
                    id: "workingfrom_year",
                    label: "Start Working Year",
                    required: 1,
                },
                {
                    id: "workingform_date",
                    label: "Start Working Month",
                    required: 1,
                },
                { id: "till_year", label: "Working Till Year", required: 1 },
                { id: "till_month", label: "Working Till Month", required: 1 },
                {
                    id: "job_description",
                    label: "Job Description",
                    required: 0,
                },
                {
                    id: "currentsalary_lacs",
                    label: "CurrentSalary Lacs",
                    required: 0,
                },
                {
                    id: "currentsalary_thousand",
                    label: "CurrentSalary Thousand",
                    required: 0,
                },
            ];
            let process = 0;
            let data = {};
            $.each(idelement, function (key, value) {
                if (
                    parentid.find(`#${value.id}`).val() == "" &&
                    value.required == 1
                ) {
                    process = 0;
                    return self.errormethod(
                        "basic",
                        value.id,
                        `Please Check the ${value.label}`
                    );
                } else {
                    process = 1;
                    data[value.id] = parentid.find(`#${value.id}`).val();
                }
            });
            if (process == 1) {
                data.currentcompany_type = $(
                    "input[name='currentcompany_type']:checked"
                ).val();
                if (data.coursetype == "Yes") {
                    data.currentsalary_lacs = $("#currentsalary_lacs").val();
                    data.currentsalary_thousand = $(
                        "#currentsalary_thousand"
                    ).val();
                }
                let compain_employement = await self.databaseeducationvalue(
                    "employment_details"
                );
                let reference_details = await self.databaseeducationvalue(
                    "employment_reference"
                );
                if (compain_employement != "") {
                    compain_employement = JSON.parse(compain_employement);
                    compain_employement[data.organization] = JSON.stringify(
                        data
                    );
                } else {
                    compain_employement = {};
                    compain_employement[data.organization] = JSON.stringify(
                        data
                    );
                }
                let tempdata = {};
                if (reference_details != "") {
                    reference_details = JSON.parse(reference_details);
                    if (
                        self.valdateundefined(
                            reference_details[data.organization]
                        ) == ""
                    ) {
                        reference_details[data.organization] = tempdata;
                    }
                } else {
                    reference_details = {};
                    reference_details[data.organization] = tempdata;
                }

                let storeval = {};
                storeval.temp_empid = self.P_B_DB.id;
                storeval.employment_details = JSON.stringify(
                    compain_employement
                );
                storeval.employment_reference = JSON.stringify(
                    reference_details
                );
                let savepersonal = await self.educationsave(storeval);
                if (savepersonal.status == "200") {
                    self.successmethod(
                        "basic",
                        "Employment Details Successfully Added"
                    );
                    $.each(idelement, function (key, value) {
                        parentid.find(`#${value.id}`).val("");
                    });
                    $("#employmentfiles").html("");
                    $("#organization").prop("readonly", false);
                    $("input[name=currentcompany_type][value=No]")
                        .prop("checked", true)
                        .trigger("change");
                }

                await self.selfedu();
                await self.employmenttriggervalue();
            }
        });
        $("body").on("click", "#reference_save", async function () {
            let parentid = $("#reference");
            parentid.find("#error").html("");
            parentid.find("#success").html("");
            let process = 0;
            let data = [];
            let reference_details = await self.databaseeducationvalue(
                "employment_reference"
            );
            reference_details = JSON.parse(reference_details);
            $("#reference_details > tr").each(function (index, tr) {
                let temp = {};
                temp.reference_org = self.valdateundefined(
                    $(this).find(".reference_org").val()
                );
                temp.reference_name = self.valdateundefined(
                    $(this).find(".reference_name").val()
                );
                temp.reference_des = self.valdateundefined(
                    $(this).find(".reference_des").val()
                );
                temp.reference_mobile = self.valdateundefined(
                    $(this).find(".reference_mobile").val()
                );
                temp.reference_email = self.valdateundefined(
                    $(this).find(".reference_email").val()
                );

                if (temp.reference_name != "" && temp.reference_name != null) {
                    reference_details[temp.reference_org] = temp;
                }
            });

            let storeval = {};
            storeval.temp_empid = self.P_B_DB.id;
            storeval.employment_reference = JSON.stringify(reference_details);
            let savepersonal = await self.educationsave(storeval);
            if (savepersonal.status == "200") {
                self.successmethod(
                    "reference",
                    "Reference Details Successfully Added"
                );
            }
            await self.selfedu();
            await self.employmenttriggervalue();
        });

        $("body").on("click", "#save_skills", async function () {
            let parentid = $("#basic");
            parentid.find("#error").html("");
            parentid.find("#success").html("");
            let idelement = [
                { id: "programme_type", label: "Programme Type", required: 1 },
                {
                    id: "programme_value",
                    label: "Programme",
                    required: 1,
                },
                {
                    id: "organization_name",
                    label: "Organization Name",
                    required: 1,
                },
                {
                    id: "start_year",
                    label: "Start Year",
                    required: 1,
                },
                { id: "start_month", label: "Start Month", required: 1 },
                { id: "end_year", label: "End Year", required: 1 },
                { id: "end_month", label: "End Month", required: 1 },
            ];
            let process = 0;
            let data = {};
            $.each(idelement, function (key, value) {
                if (
                    parentid.find(`#${value.id}`).val() == "" &&
                    value.required == 1
                ) {
                    process = 0;
                    return self.errormethod(
                        "basic",
                        value.id,
                        `Please Check the ${value.label}`
                    );
                } else {
                    process = 1;
                    data[value.id] = parentid.find(`#${value.id}`).val();
                }
            });
            if (process == 1) {
                let compain_graducation = await self.databaseeducationvalue(
                    "skill_details"
                );
                if (compain_graducation != "") {
                    compain_graducation = JSON.parse(compain_graducation);
                    compain_graducation[data.programme_value] = JSON.stringify(
                        data
                    );
                } else {
                    compain_graducation = {};
                    compain_graducation[data.programme_value] = JSON.stringify(
                        data
                    );
                }

                let storeval = {};
                storeval.temp_empid = self.P_B_DB.id;
                storeval.skill_details = JSON.stringify(compain_graducation);
                // console.log(storeval);
                let savepersonal = await self.educationsave(storeval);
                if (savepersonal.status == "200") {
                    self.successmethod(
                        "basic",
                        "Skill Details Successfully Added"
                    );
                    $.each(idelement, function (key, value) {
                        parentid.find(`#${value.id}`).val("");
                    });
                    await self.selfedu();
                    await self.skilltriggervalue();
                }
            }
        });
        $("body").on("click", "#save_computer_skills", async function () {
            let parentid = $("#computer");
            parentid.find("#error").html("");
            parentid.find("#success").html("");
            let process = [];
            $("#computer_knowledge > tr").each(function (index, tr) {
                let temp = {};
                temp.cpk = $(this).find(".cpk").val();
                temp.application = $(this).find(".application").val();
                temp.knowledge = $(this).find(".knowledge").val();
                if (temp.application != "" && temp.application != null) {
                    process.push(temp);
                } else {
                    $(this).find(".application").focus();
                    process = [];
                }
            });
            let data = {};
            if (process.length > 0) {
                data.temp_empid = self.P_B_DB.id;
                data.computer_skill_details = JSON.stringify(process);
                let savepersonal = await self.educationsave(data);
                if (savepersonal.status == "200") {
                    self.successmethod(
                        "computer",
                        "Computer Successfully Added"
                    );
                }
            }
        });

        $("body").on("click", "#save_other_details", async function (e) {
            e.preventDefault();
            let parentid = $(this).closest(".tab-pane").attr("id");
            let process = [];
            $(`#${parentid}`)
                .find(".row")
                .each(function () {
                    //let checkbox = $(".checkboxchecked")
                    let temp = {};
                    let nameval = $(this).find(".checkboxchecked").attr("name");
                    let checkedval = $(`input[name=${nameval}]:checked`).val();
                    //console.log(checkedval);
                    let extrainfo = "";
                    if (checkedval == "Yes") {
                        extrainfo = $(this).find("textarea").val();

                        if (extrainfo == "") {
                            $(this).find("textarea").focus();
                            $("#basic")
                                .find("#error")
                                .html("Please give the details");
                        } else {
                            temp["name"] = nameval;
                            temp["checkedval"] = checkedval;
                            temp.info = extrainfo;
                        }
                    } else {
                        temp["name"] = nameval;
                        temp["checkedval"] = checkedval;
                        temp.info = "";
                    }
                    process.push(temp);
                });
            //nash_working_details
            //console.log(process);

            let data = {};
            if (process.length > 0) {
                data.temp_empid = self.P_B_DB.id;
                data.nash_working_details = JSON.stringify(process);
                let savepersonal = await self.educationsave(data);
                if (savepersonal.status == "200") {
                    self.successmethod("basic", "Details Saved Successfully ");
                }
            }
        });
        $("body").on("click", "#save_strength_details", async function (e) {
            e.preventDefault();
            let parentid = $(this).closest(".tab-pane").attr("id");
            $(`#${parentid}`).find("#error").html("");
            $(`#${parentid}`).find("#success").html("");
            let process = [];
            $("#strength_week > tr").each(function (index, tr) {
                let temp = {};
                temp.strength = $(this).find(".strengthclass").val();
                temp.weekness = $(this).find(".weaknessclass").val();
                if (temp.strength != "" && temp.weekness != "") {
                    process.push(temp);
                } else {
                    $(this).find(".strengthclass").focus();
                    process = [];
                }
            });
            let data = {};
            if (process.length > 0) {
                data.temp_empid = self.P_B_DB.id;
                data.strength_details = JSON.stringify(process);
                let savepersonal = await self.educationsave(data);
                if (savepersonal.status == "200") {
                    self.successmethod(
                        "strength",
                        "Strength Successfully Added"
                    );
                }
            }
        });

        $("body").on("click", ".graduation_populate", async function () {
            let select_list_val = $(this).data("graduate");
            let compain_graducation = await self.databaseeducationvalue(
                "graduation_details"
            );
            if (compain_graducation != "") {
                compain_graducation = JSON.parse(compain_graducation);
                let slv = compain_graducation[select_list_val];
                if (slv != undefined) {
                    slv = JSON.parse(slv);
                    $("#ugcourse").val(slv.ugcourse).trigger("change");
                    $("#university").val(slv.university);
                    $("#ugspecilaization").val(slv.ugspecilaization);
                    $("#uggradingsystem").val(slv.uggradingsystem);
                    $("#ugmarks").val(slv.ugmarks);
                    $("#graduation")
                        .find(
                            `input[name=ugcoursetype][value="${slv.coursetype}"]`
                        )
                        .prop("checked", true);
                }
                await self.clicktriggerfile("education", slv.ugcourse, "UG");
            }
        });
        $("body").on("click", ".pggraduation_populate", async function () {
            let select_list_val = $(this).data("graduate");
            let compain_graducation = await self.databaseeducationvalue(
                "master_details"
            );
            if (compain_graducation != "") {
                compain_graducation = JSON.parse(compain_graducation);
                let slv = compain_graducation[select_list_val];
                if (slv != undefined) {
                    slv = JSON.parse(slv);
                    $("#pgcourse").val(slv.pgcourse).trigger("change");
                    $("#pguniversity").val(slv.pguniversity);
                    $("#pgspecilaization").val(slv.pgspecilaization);
                    $("#pggradingsystem").val(slv.pggradingsystem);
                    $("#pgmarks").val(slv.pgmarks);
                    $("#master")
                        .find(
                            `input[name=pgcoursetype][value="${slv.coursetype}"]`
                        )
                        .prop("checked", true);
                }
                await self.clicktriggerfile("education", slv.pgcourse, "PG");
            }
        });
        $("body").on("click", ".doctorate_populate", async function () {
            let select_list_val = $(this).data("graduate");
            let compain_graducation = await self.databaseeducationvalue(
                "doctorate_details"
            );
            console.log(compain_graducation);
            if (compain_graducation != "") {
                compain_graducation = JSON.parse(compain_graducation);
                let slv = compain_graducation[select_list_val];
                if (slv != undefined) {
                    slv = JSON.parse(slv);
                    $("#doctorate_course")
                        .val(slv.doctorate_course)
                        .trigger("change");
                    $("#docuniversity").val(slv.docuniversity);
                    $("#doctorate_specilaization").val(
                        slv.doctorate_specilaization
                    );
                    $("#docgradingsystem").val(slv.docgradingsystem);
                    $("#docmarks").val(slv.docmarks);
                    $("#doctor")
                        .find(
                            `input[name=doccoursetype][value="${slv.coursetype}"]`
                        )
                        .prop("checked", true);
                }
                await self.clicktriggerfile(
                    "education",
                    slv.doctorate_course,
                    "Doct"
                );
            }
        });
        $("body").on("click", ".employment_populate", async function () {
            let select_list_val = $(this).data("graduate");
            let compain_graducation = await self.databaseeducationvalue(
                "employment_details"
            );
            if (compain_graducation != "") {
                compain_graducation = JSON.parse(compain_graducation);
                let slv = compain_graducation[select_list_val];
                if (slv != undefined) {
                    slv = JSON.parse(slv);
                    $("#organization").val(slv.organization);
                    $("#designation").val(slv.designation);
                    $("#workingfrom_year").val(slv.workingfrom_year);
                    $("#workingform_date").val(slv.workingform_date);
                    $("#till_year").val(slv.till_year);
                    $("#till_month").val(slv.till_month);
                    $("#job_description").val(slv.job_description);
                    $("#basic")
                        .find(
                            `input[name=currentcompany_type][value="${slv.currentcompany_type}"]`
                        )
                        .prop("checked", true);
                    if (slv.currentcompany_type == "Yes") {
                        $("#currentsalary").show();
                        $("#currentsalary_lacs").val(slv.currentsalary_lacs);
                        $("#currentsalary_thousand").val(
                            slv.currentsalary_thousand
                        );
                    } else {
                        $("#currentsalary").hide();
                    }
                    $("#organization").prop("readOnly", true);
                    await self.clicktriggerfile(
                        "previousemployee",
                        slv.organization,
                        "employee"
                    );
                }
            }
        });
        $("body").on("click", ".skill_populate", async function () {
            let select_list_val = $(this).data("graduate");
            let compain_skills = await self.databaseeducationvalue(
                "skill_details"
            );
            if (compain_skills != "") {
                compain_skills = JSON.parse(compain_skills);
                let slv = compain_skills[select_list_val];
                if (slv != undefined) {
                    slv = JSON.parse(slv);
                    $("#programme_type").val(slv.programme_type);
                    $("#programme_value").val(slv.programme_value);
                    $("#organization_name").val(slv.organization_name);
                    $("#start_year").val(slv.start_year);
                    $("#start_month").val(slv.start_month);
                    $("#end_year").val(slv.end_year);
                    $("#end_month").val(slv.end_month);
                }
            }
        });

        $("body").on("click", ".strength_add_btn", function () {
            let html = ` <tr>               
            <td><textarea class="form-control strengthclass" placeholder="Strength"></textarea></td>
            <td><textarea class="form-control weeknessclass" placeholder="Weekness"></textarea></td>
            <td><button class="btn btn-success strength_add_btn"><i class="fa fa-plus"></i></button>
            <button class="btn btn-success strength_delete_btn"><i class="fa fa-trash"></i></button>
            </td>                        
    </tr>`;
            $("#strength_week").append(html);
        });
        $("body").on("click", ".ckplusevent", function () {
            var div = self.computerknowledge();
            $("#computer_knowledge").append(div);
        });
        $("body").on("click", ".ckevent", function () {
            $(this).closest("tr").remove();
        });
        $("body").on("click", ".eduaddbtn", function () {
            let filename = $(this).closest("tr").find(".filenames").val();
            let basename = $(this)
                .closest("tr")
                .find(".filenames")
                .data("basename");
            let parentid = $(this).closest(".tab-pane").attr("id");
            $(`#${parentid}`).find("#success").html("");
            let addtd = $(this).data("ids");
            if (addtd != "") {
                let filedet = self.fileuploadhtml(
                    basename,
                    filename,
                    "",
                    "education",
                    "yes",
                    "",
                    "",
                    "",
                    "",
                    "addbtn",
                    ""
                );
                $(this).closest("tbody").append(filedet);
            } else {
                // let parentid = $(this).closest(".tab-pane").attr("id");
                $(this).closest("tr").find(".filenames").focus();
                self.successmethod(parentid, "*Please update the above file");
            }
        });
        $("body").on("click", ".upload-button", function () {
            $(".file-upload").click();
        });
        $(".file-upload").on("change", async function () {
            self.readURL(this);
            let tempid = self.P_B_DB.id;
            let formData = new FormData();
            let file = $(this)[0].files[0];
            formData.append("file", file, file.name);
            formData.append("tempid", tempid);
            let savefiles = await self.profilefilestored(formData);
        });
    }

    profileimage() {
        let self = this;
        self.readURL = function (input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(".profile-pic").attr("src", e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        };
    }

    activaTab(tab) {
        $(".modal-body")
            .find('.nav-tabs a[href="#' + tab + '"]')
            .tab("show");
    }

    async personaldetails_basic() {
        let self = this;
        let datavalue = "";
        if (self.P_P_DB != undefined) {
            datavalue = self.P_P_DB;
        }

        return `<div class="row">
                    ${await self.inputelement(
                        "First Name",
                        "input",
                        "text",
                        ["form-control"],
                        "firstname",
                        "First Name",
                        "required",
                        datavalue != "" && datavalue.firstname != null
                            ? datavalue.firstname
                            : ""
                    )}
                    ${await self.inputelement(
                        "Middle Name:",
                        "input",
                        "text",
                        ["form-control"],
                        "middlename",
                        "Middle Name",
                        "required",
                        datavalue != "" && datavalue.middlename != null
                            ? datavalue.middlename
                            : ""
                    )}
                    ${await self.inputelement(
                        "Last Name:",
                        "input",
                        "text",
                        ["form-control"],
                        "lastname",
                        "Last Name",
                        "required",
                        datavalue != "" && datavalue.middlename != null
                            ? datavalue.middlename
                            : ""
                    )}
                    ${await self.inputelement(
                        "Date of Birth*:",
                        "input",
                        "text",
                        ["form-control", "datepicker"],
                        "dob",
                        "D.O.B",
                        "",
                        datavalue != "" && datavalue.dob != null
                            ? datavalue.dob
                            : ""
                    )}   
                    
                    ${await self.selectelement(
                        "Gender*:",
                        "select",
                        ["form-control"],
                        "gender",
                        [
                            {
                                "Select Gender": "",
                                Male: "Male",
                                Female: "Female",
                                Transgender: "Others",
                            },
                        ],
                        datavalue != "" && datavalue.gender != null
                            ? datavalue.gender
                            : ""
                    )}    
                    ${await self.selectelement(
                        "Blood Group*:",
                        "select",
                        ["form-control"],
                        "bloodgroup",
                        [
                            {
                                "Select BloodGroup": "",
                                "O Postive(O+)": "O+",
                                "O Negative(O-)": "O-",
                                "A Postive(A+)": "A+",
                                "A Negative(A-)": "A-",
                                "B Postive(B+)": "B+",
                                "B Negative(B-)": "B-",
                                "AB Postive(AB+)": "AB+",
                                "AB Negative(AB-": "AB-",
                            },
                        ],
                        datavalue != "" && datavalue.bloodgroup != null
                            ? datavalue.bloodgroup
                            : ""
                    )}   
                    ${await self.selectelement(
                        "Martial Status:",
                        "select",
                        ["form-control"],
                        "martialstatus",
                        [
                            {
                                "Select Martial Status": "",
                                Single: "Single",
                                Married: "Married",
                                Widowed: "Widowed",
                                Divorced: "Divorced",
                            },
                        ],
                        datavalue != "" && datavalue.martialstatus != null
                            ? datavalue.martialstatus
                            : ""
                    )}    
      
        <div class="col-md-4">
        <div class="form-group">
            <label>Are You Differently Abled ?</label><br>
        <label><input type="radio" value="Yes" style="margin:8px" name="differently_type"> Yes</label><label><input type="radio" style="margin:8px" name="differently_type" value="No" checked>No </label>
        </div>
        </div> 
        ${await self.selectelement(
            "Religion",
            "select",
            ["form-control"],
            "religion",
            [
                {
                    "Select Religion": "",
                    Christianity: "Christianity",
                    Islam: "Islam",
                    Hinduism: "Hinduism",
                    Unaffiliated: "Unaffiliated",
                    Buddhism: "Buddhism",
                    "Folk Religion": "Folk Religion",
                    Other: "Other",
                },
            ],
            datavalue != "" && datavalue.religion != null
                ? datavalue.religion
                : ""
        )}      
        <div class="col-md-4" id="anniversary_date"></div>
        <div class="col-md-4" id="differently_abled"></div>
        <div class="col-md-4" id="differently_abled_type_html"></div>                                           
      </div>`;
    }
    async personaldetails_contact() {
        let self = this;
        let datavalue = "";
        if (self.P_P_DB != undefined) {
            datavalue = self.P_P_DB;
        }

        return `<div class="row" >
        ${await self.inputelement(
            "Email*",
            "input",
            "text",
            ["form-control"],
            "email_id",
            "Email",
            "required",
            datavalue != "" && datavalue.email_id != null
                ? datavalue.email_id
                : ""
        )}
        ${await self.inputelement(
            "Mobile No*",
            "input",
            "text",
            ["form-control"],
            "mobileno",
            "Mobile No",
            "required",
            datavalue != "" && datavalue.mobileno != null
                ? datavalue.mobileno
                : ""
        )}       
        ${await self.inputelement(
            "Land Line No*",
            "input",
            "text",
            ["form-control"],
            "landlineno",
            "Land Line No",
            "required",
            datavalue != "" && datavalue.landlineno != null
                ? datavalue.landlineno
                : ""
        )}
        ${await self.inputelement(
            "Alternate Mobile No*",
            "input",
            "text",
            ["form-control"],
            "alternate_mobile",
            "Alternate Mobile No",
            "required",
            datavalue != "" && datavalue.alternate_mobile != null
                ? datavalue.alternate_mobile
                : ""
        )}      
    </div>`;
    }
    async triggervalue() {
        let self = this;
        let datavalue = "";
        if (self.P_P_DB != undefined) {
            datavalue = self.P_P_DB;
        }
        if (datavalue != "") {
            if (datavalue.present_country != null) {
                let presentstate = "";
                let presentstatelist = await self.joiningstatelist(
                    datavalue.present_country
                );
                presentstate = `<option>Select State</option>`;
                if (presentstatelist.status == 200) {
                    $.each(presentstatelist.data.state, function (key, val) {
                        presentstate += `<option value=${val.id}>${val.state_name}</option>`;
                    });
                }
                $("#Address").find("#present_state").html(presentstate);
            }
            if (datavalue.present_state != null) {
                let presentcity = "";
                let presentcitylist = await self.joiningcitylist(
                    datavalue.present_state
                );
                presentcity = `<option>Select city</option>`;
                if (presentcitylist.status == 200) {
                    $.each(presentcitylist.data.city, function (key, val) {
                        presentcity += `<option value=${val.id}>${val.city_name}</option>`;
                    });
                }
                $("#Address").find("#present_city").html(presentcity);
            }
            if (datavalue.permanent_country != null) {
                let peramentstate = "";
                let peramentstatelist = await self.joiningstatelist(
                    datavalue.permanent_country
                );
                peramentstate = `<option>Select State</option>`;
                if (peramentstatelist.status == 200) {
                    $.each(peramentstatelist.data.state, function (key, val) {
                        peramentstate += `<option value=${val.id}>${val.state_name}</option>`;
                    });
                }
                $("#Address").find("#permanent_state").html(peramentstate);
            }
            if (datavalue.permanent_state != null) {
                let peramentcity = "";

                let peramentcitylist = await self.joiningcitylist(
                    datavalue.permanent_state
                );
                peramentcity = `<option>Select city</option>`;
                if (peramentcitylist.status == 200) {
                    $.each(peramentcitylist.data.city, function (key, val) {
                        peramentcity += `<option value=${val.id}>${val.city_name}</option>`;
                    });
                }
                $("#Address").find("#permanent_city").html(peramentcity);
            }
            if (datavalue.present_country != null) {
                $("#present_country").val(datavalue.present_country);
            }
            if (datavalue.present_state != null) {
                $("#present_state").val(datavalue.present_state);
            }
            if (datavalue.present_state != null) {
                $("#present_city").val(datavalue.present_city);
            }
            if (datavalue.permanent_country != null) {
                $("#permanent_country").val(datavalue.permanent_country);
            }
            if (datavalue.permanent_state != null) {
                $("#permanent_state").val(datavalue.permanent_state);
            }
            $("#permanent_city").val(
                await self.databasevalue("permanent_city")
            );
            let family = await self.databasevalue("family_details");
            if (family != "") {
                let trN = ``;
                family = JSON.parse(family);
                $.each(family, function (key, value) {
                    trN += `<tr>                                
                        <td><input type="text" class="form-control names" value="${value.name}"  placeholder="Name"></td>
                        <td><input type="text" class="form-control relationship" placeholder="Relationship" value="${value.relationship}"></td>
                        <td><input type="text" class="form-control age"     placeholder="Age" value="${value.age}"></td>
                        <td><input type="text" class="form-control education" placeholder="Education" value="${value.education}"></td>
                        <td><input type="text" class="form-control occuption" placeholder="Occuption" value="${value.occuption}"></td>`;
                    if (key == 0) {
                        trN += `<td><span><i class="fa fa-plus plusevent" aria-hidden="true"></i></span></td>`;
                    } else {
                        trN += `<td><span><i class="fa fa-plus plusevent" aria-hidden="true"></i></span><span><i class="fa fa-trash removeevent" aria-hidden="true"></i></span></td>`;
                    }
                    trN += `</tr>`;
                });
                $("#TextBoxContainer").html(trN);
                //console.log(trN);
            }
            let languages = await self.databasevalue("language_details");
            if (languages != "") {
                let lan = `<div class="row">
                <div class="col-md-3">
                    <label>Language*</label>
                </div>
                <div class="col-md-3">
                    <label>Proficiency*</label>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Proficiency Details*</label>
                    </div>
                </div>               
            </div>`;
                let languagejson = JSON.parse(languages);
                $.each(languagejson, function (key, val) {
                    lan += `<div class="row" id="${val.rowid}">
                <div class="col-md-3">
                    <input type="text" value="${
                        val.inputtext
                    }" class="form-control inputtext" placeholder="" autocomplete="off">    
                </div>
                <div class="col-md-3">
                    <select class="form-control inputselect">
                            <option ${
                                val.inputselect == "Beginner" ? "selected" : ""
                            }>Beginner</option>
                            <option ${
                                val.inputselect == "Mother Tongue"
                                    ? "selected"
                                    : ""
                            }>Mother Tongue</otpion>
                            <option ${
                                val.inputselect == "Proficient"
                                    ? "selected"
                                    : ""
                            }>Proficient</option>
                            <option ${
                                val.inputselect == "Expert" ? "selected" : ""
                            }>Expert</option>
                        </select>                
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="Checkbox" style="margin: 12px 10px;-webkit-transform: scale(1.5);" class="inputread" autocomplete="off" ${
                            val.inputread == "yes" ? "checked" : ""
                        }>Read <input style="margin: 12px 10px;-webkit-transform: scale(1.5);" type="Checkbox" class="inputwrite" autocomplete="off"  ${
                        val.inputwrite == "yes" ? "checked" : ""
                    }>Write <input style="margin:12px 10px;-webkit-transform: scale(1.5);" type="Checkbox" class="inputspeak" autocomplete="off"  ${
                        val.inputspeak == "yes" ? "checked" : ""
                    }>Speak
                    </div>
                </div>
                
            </div>`;
                });
                $("#languages").find("#languagehtml").html(lan);
            }
        }
    }
    async triggerfilevalue(base) {
        let self = this;
        let files = await self.databasesavefile(self.P_B_DB.id, base);
        let trn = ``;
        if (files.status == 200) {
            if (
                files.data.details != undefined &&
                files.data.details.length > 0
            ) {
                trn = ``;

                if (base == "personal") {
                    $.each(files.data.details, function (key, value) {
                        let regen = "";
                        if (self.valdateundefined(value.removebtn) == "no") {
                            regen = "yes";
                        }
                        let hreflink = `${self.url}storage/HrFiles/${value.file_path}`;

                        trn += self.fileuploadhtml(
                            value.basename,
                            value.file_name,
                            self.valdateundefined(value.file_description),
                            self.valdateundefined(value.file_base_path),
                            "",
                            value.id,
                            regen,
                            hreflink,
                            "no",
                            "",
                            value.employee_verified_status
                        );
                    });
                    $("#files").find(".file_details").html(trn);
                }
                if (base == "education") {
                    let sslc = "";
                    let hsc = "";
                    let sslcval = 0;
                    let hscval = 0;
                    $.each(files.data.details, function (key, value) {
                        let regen = "";
                        if (self.valdateundefined(value.removebtn) == "no") {
                            regen = "yes";
                        }
                        let hreflink = `${self.url}storage/HrFiles/${value.file_path}`;
                        if (value.basename == "Sslc") {
                            sslc += self.fileuploadhtml(
                                value.basename,
                                value.file_name,
                                self.valdateundefined(value.file_description),
                                self.valdateundefined(value.file_base_path),
                                "",
                                value.id,
                                regen,
                                hreflink,
                                "no",
                                "addbtn",
                                value.employee_verified_status
                            );
                            sslcval = 1;
                        }
                        if (value.basename == "Hsc") {
                            hsc += self.fileuploadhtml(
                                value.basename,
                                value.file_name,
                                self.valdateundefined(value.file_description),
                                self.valdateundefined(value.file_base_path),
                                "",
                                value.id,
                                regen,
                                hreflink,
                                "no",
                                "addbtn",
                                value.employee_verified_status
                            );
                            hscval = 1;
                        }
                    });
                    if (sslcval == 1) {
                        $("#basic").find(".file_details").html(sslc);
                    }
                    if (hscval == 1) {
                        $("#hsc").find(".file_details").html(hsc);
                    }
                }
            }
        }
    }
    async clicktriggerfile(base, filename, basenamefile) {
        let self = this;
        let files = await self.databasesavefile(self.P_B_DB.id, base);
        let ug = "";
        let pg = "";
        let doc = "";
        let ugval = 0;
        let pgval = 0;
        let docval = 0;
        let emp = "";
        let employeeval = 0;
        if (files.status == 200) {
            if (
                files.data.details != undefined &&
                files.data.details.length > 0
            ) {
                if (base == "education") {
                    $.each(files.data.details, function (key, value) {
                        let regen = "";
                        if (self.valdateundefined(value.removebtn) == "no") {
                            regen = "yes";
                        }
                        let hreflink = `${self.url}storage/HrFiles/${value.file_path}`;
                        if (
                            basenamefile == "UG" &&
                            value.file_name == filename
                        ) {
                            ug += self.fileuploadhtml(
                                value.basename,
                                value.file_name,
                                self.valdateundefined(value.file_description),
                                self.valdateundefined(value.file_base_path),
                                "",
                                value.id,
                                regen,
                                hreflink,
                                "no",
                                "addbtn",
                                value.employee_verified_status
                            );
                            ugval = 1;
                        }
                        if (
                            basenamefile == "PG" &&
                            value.file_name == filename
                        ) {
                            pg += self.fileuploadhtml(
                                value.basename,
                                value.file_name,
                                self.valdateundefined(value.file_description),
                                self.valdateundefined(value.file_base_path),
                                "",
                                value.id,
                                regen,
                                hreflink,
                                "no",
                                "addbtn",
                                value.employee_verified_status
                            );
                            pgval = 1;
                        }
                        if (
                            basenamefile == "Doct" &&
                            value.file_name == filename
                        ) {
                            doc += self.fileuploadhtml(
                                value.basename,
                                value.file_name,
                                self.valdateundefined(value.file_description),
                                self.valdateundefined(value.file_base_path),
                                "",
                                value.id,
                                regen,
                                hreflink,
                                "no",
                                "addbtn",
                                value.employee_verified_status
                            );
                            docval = 1;
                        }
                    });
                }
                if (base == "previousemployee") {
                    $.each(files.data.details, function (key, value) {
                        let regen = "";
                        if (self.valdateundefined(value.removebtn) == "no") {
                            regen = "yes";
                        }
                        let hreflink = `${self.url}storage/HrFiles/${value.file_path}`;
                        if (
                            basenamefile == "employee" &&
                            value.file_name == filename
                        ) {
                            emp += self.fileuploadhtml(
                                value.basename,
                                value.file_name,
                                self.valdateundefined(value.file_description),
                                self.valdateundefined(value.file_base_path),
                                "",
                                value.id,
                                regen,
                                hreflink,
                                "no",
                                "addbtn",
                                value.employee_verified_status
                            );
                            employeeval = 1;
                        }
                    });
                }
            }
        }
        if (base == "education") {
            if (basenamefile == "UG") {
                if (ugval == 1) {
                    $("body")
                        .find("#graduation")
                        .find(".file_details")
                        .html(ug);
                } else {
                    let ugfiles = self.fileuploadhtml(
                        "UG",
                        filename,
                        "Marksheet",
                        "education",
                        "removebtn",
                        "",
                        "regen",
                        "",
                        "",
                        "addbtn",
                        ""
                    );
                    $("body")
                        .find("#graduation")
                        .find(".file_details")
                        .html(ugfiles);
                }
            }
            if (basenamefile == "PG") {
                if (pgval == 1) {
                    $("body").find("#master").find(".file_details").html(pg);
                } else {
                    let pgfiles = self.fileuploadhtml(
                        "PG",
                        filename,
                        "Marksheet",
                        "education",
                        "removebtn",
                        "",
                        "regen",
                        "",
                        "",
                        "addbtn",
                        ""
                    );
                    $("body")
                        .find("#master")
                        .find(".file_details")
                        .html(pgfiles);
                }
            }
            if (basenamefile == "Doct") {
                if (docval == 1) {
                    $("body").find("#doctor").find(".file_details").html(doc);
                } else {
                    let docfiles = self.fileuploadhtml(
                        "Doct",
                        filename,
                        "Marksheet",
                        "education",
                        "removebtn",
                        "",
                        "regen",
                        "",
                        "",
                        "addbtn",
                        ""
                    );
                    $("body")
                        .find("#doctor")
                        .find(".file_details")
                        .html(docfiles);
                }
            }
        }

        if (base == "previousemployee") {
            if (employeeval == 1) {
                $("body").find("#basic").find(".file_details").html(emp);
            } else {
                let empfiles = self.fileuploadhtml(
                    "employee",
                    filename,
                    "Resignation Letter",
                    "previousemployee",
                    "removebtn",
                    "",
                    "regen",
                    "",
                    "",
                    "addbtn",
                    ""
                );
                $("body").find("#employmentfiles").html(empfiles);
            }
        }
    }

    async edutriggervalue() {
        let self = this;
        let sslc_details = await self.databaseeducationvalue("sslc_details");
        if (sslc_details != "") {
            sslc_details = JSON.parse(sslc_details);
            $("#sslcboard").val(sslc_details.sslcboard);
            $("#passing_out").val(sslc_details.passing_out);
            $("#sslcmedium").val(sslc_details.sslcmedium);
            $("#sslcmarks").val(sslc_details.sslcmarks);
        }
        let hsc_details = await self.databaseeducationvalue("hsc_details");
        if (hsc_details != "") {
            hsc_details = JSON.parse(hsc_details);
            $("#hscboard").val(hsc_details.hscboard);
            $("#hsc_passing_out").val(hsc_details.hsc_passing_out);
            $("#hsc_medium").val(hsc_details.hsc_medium);
            $("#hsc_marks").val(hsc_details.hsc_marks);
        }
        let graducation_details = await self.databaseeducationvalue(
            "graduation_details"
        );
        if (graducation_details != "") {
            graducation_details = JSON.parse(graducation_details);
            let graduation_keys = Object.keys(graducation_details);
            //console.log(graduation_keys);
            let graduationlist = ``;
            $.each(graduation_keys, function (key, value) {
                graduationlist += `<li class="list-inline-item col-md-2">
                <button class="btn btn-link graduation_populate" data-graduate="${value}">${value}</button></li>`;
            });
            $("#graduation").find("#list_of_graduation").html(graduationlist);
        }
        let pfgraducation_details = await self.databaseeducationvalue(
            "master_details"
        );
        if (pfgraducation_details != "") {
            pfgraducation_details = JSON.parse(pfgraducation_details);
            let graduation_keys = Object.keys(pfgraducation_details);

            let graduationlist = ``;
            $.each(graduation_keys, function (key, value) {
                graduationlist += `<li class="list-inline-item col-md-2">
                <button class="btn btn-link pggraduation_populate" data-graduate="${value}">${value}</button></li>`;
            });
            $("#master").find("#list_of_graduation").html(graduationlist);
        }
        let docgraducation_details = await self.databaseeducationvalue(
            "doctorate_details"
        );
        if (docgraducation_details != "") {
            docgraducation_details = JSON.parse(docgraducation_details);
            let graduation_keys = Object.keys(docgraducation_details);

            let graduationlist = ``;
            $.each(graduation_keys, function (key, value) {
                graduationlist += `<li class="list-inline-item col-md-2">
                <button class="btn btn-link doctorate_populate" data-graduate="${value}">${value}</button></li>`;
            });
            $("#doctor").find("#list_of_graduation").html(graduationlist);
        }
    }
    async employmenttriggervalue() {
        let self = this;
        let employment_details = await self.databaseeducationvalue(
            "employment_details"
        );
        let reference_details = await self.databaseeducationvalue(
            "employment_reference"
        );

        if (employment_details != "") {
            employment_details = JSON.parse(employment_details);
            let reference_object = JSON.parse(reference_details);
            let employment_keys = Object.keys(employment_details);

            let employeelist = ``;
            let reference = "";
            $.each(employment_keys, function (key, value) {
                employeelist += `<li class="list-inline-item col-md-6">
                <button class="btn btn-link employment_populate" data-graduate="${value}">${value}</button></li>`;
            });
            console.log(reference_object);

            $.each(reference_object, function (key, value) {
                reference += `<tr>
                <td><input type="text" class="form-control reference_org" readonly value="${self.valdateundefined(
                    key
                )}" placeholder="Organization Name"></td>
                <td><input type="text" class="form-control reference_name" placeholder="Name" value="${self.valdateundefined(
                    value.reference_name
                )}"></td>
                <td><input type="text" class="form-control reference_des" placeholder="Designation" value="${self.valdateundefined(
                    value.reference_des
                )}"></td>
                <td><input type="text" class="form-control reference_mobile" placeholder="Mobile No" value="${self.valdateundefined(
                    value.reference_mobile
                )}"></td>
                <td><input type="text" class="form-control reference_email" placeholder="Email" value="${self.valdateundefined(
                    value.reference_email
                )}"></td>
                </tr>`;
            });
            $("#reference").find("#reference_details").html(reference);
            $("#basic").find("#list_of_employment").html(employeelist);
        }
    }
    async skilltriggervalue() {
        let self = this;
        let skill_details = await self.databaseeducationvalue("skill_details");
        if (skill_details != "") {
            skill_details = JSON.parse(skill_details);
            let skill_keys = Object.keys(skill_details);
            //console.log(graduation_keys);
            let skil_list = ``;
            $.each(skill_keys, function (key, value) {
                skil_list += `<li class="list-inline-item col-md-2">
                <button class="btn btn-link skill_populate" data-graduate="${value}">${value}</button></li>`;
            });
            $("#basic").find("#list_of_skills").html(skil_list);
        }

        let computerskils = await self.databaseeducationvalue(
            "computer_skill_details"
        );
        if (computerskils != "") {
            let trN = ``;
            computerskils = JSON.parse(computerskils);
            $.each(computerskils, function (key, value) {
                trN += `<tr>               
                <td><select class="form-control cpk" >
                    <option value="">Select Option</option>
                    <option value="Mso" ${
                        value.cpk == "Mso" ? "selected" : ""
                    }>MS Office(Word; Excel; Power Point)</option>
                    <option value="erp" ${
                        value.cpk == "erp" ? "selected" : ""
                    }>ERP</option>
                    <option value="ds" ${
                        value.cpk == "ds" ? "selected" : ""
                    }>Designing Software</option>
                    <option value="os" ${
                        value.cpk == "os" ? "selected" : ""
                    }>Others, Specify</option>
                  </select></td>
                <td><input type="text" class="form-control application" value="${
                    value.application
                }" autocomplete="off"></td>
                <td>
                <select class="form-control knowledge" value="${
                    value.knowledge
                }">
                <option value="">Select Option</option>
                      <option value="kob" ${
                          value.knowledge == "kob" ? "selected" : ""
                      }>Know only Basic</option>
                      <option value="hws" ${
                          value.knowledge == "hws" ? "selected" : ""
                      }>Has Working Skils</option>
                      <option value="iw" ${
                          value.knowledge == "iw" ? "selected" : ""
                      }>Independently Work</option>
                      <option value="exp" ${
                          value.knowledge == "exp" ? "selected" : ""
                      }>Expert</option>
                </select>
                </td>`;
                if (key == 0) {
                    trN += `<td><span><i class="fa fa-plus ckplusevent" aria-hidden="true"></i></span></td>`;
                } else {
                    trN += `<td><span><i class="fa fa-plus ckplusevent" aria-hidden="true"></i></span><span><i class="fa fa-trash ckevent" aria-hidden="true"></i></span></td>`;
                }
                trN += `</tr>`;
            });
            $("#computer_knowledge").html(trN);
            //console.log(trN);
        }
    }
    async triggerotherdetails() {
        let self = this;
        let other_details = await self.databaseeducationvalue(
            "nash_working_details"
        );
        if (other_details != "") {
            let other_det = JSON.parse(other_details);
            //console.log(other_det);
            // $("input[name=][value='some value']").prop("checked", true);
            $.each(other_det, function (key, val) {
                $(`input[name=${val.name}][value=${val.checkedval}]`).prop(
                    "checked",
                    true
                );
                if (val.checkedval == "Yes") {
                    $("#basic")
                        .find(`textarea[name=${val.name}]`)
                        .val(val.info);
                    $("#basic").find(`textarea[name=${val.name}]`).show();
                }
            });
        }
    }

    async pesonaldetails_address() {
        let self = this;
        let datavalue = "";
        if (self.P_P_DB != undefined) {
            datavalue = self.P_P_DB;
        }
        let country = `<option>Select Country</option>`;
        if (self.countrydetails != "") {
            $.each(self.countrydetails, function (key, val) {
                country += `<option value=${val.id}>${val.country_name}</option>`;
            });
        }

        return `<div class="row" >
        <div class="col-md-12">
          <label>Present Address </label>
          <textarea class="form-control" id="present_address" placeholder="Enter Address..">${
              datavalue.present_address != null ? datavalue.present_address : ""
          }
          </textarea>
          </div>
          <div class="col-md-4">
          <div class="form-group">
              <label>Country*</label>
              <select class="form-control" id="present_country" value="${
                  datavalue.present_country != null
                      ? datavalue.present_country
                      : ""
              }" >
                ${country}
              </select>
          </div>
          </div>
          <div class="col-md-4">
              <div class="form-group">
              <label>State*</label>
              <select class="form-control" id="present_state">
               
              </select>
              </div>
          </div>
              <div class="col-md-4">
              <div class="form-group">
                  <label>City*</label>
                  <select class="form-control" id="present_city">
                
                  </select>
              </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label>Pincode</label>
                      <input type="text" class="form-control" id="present_pincode" placeholder="" value="${
                          datavalue.present_pincode != null
                              ? datavalue.present_pincode
                              : ""
                      }">
                  </div>
                  </div>
                  <div class="col-md-12">
                  <label>Permanent Address  <span style="color:green">Same As Above</span> <input type="checkbox" name="same_as_above"></label>
                  <textarea class="form-control" id="permanent_address" placeholder="Select Address..">${
                      datavalue.permanent_address != null
                          ? datavalue.permanent_address
                          : ""
                  }</textarea>
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                      <label>Country*</label>
                      <select class="form-control" id="permanent_country">
                      ${country}
                      </select>
                  </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                      <label>State*</label>
                      <select class="form-control" id="permanent_state">
                         
                      </select>
                      </div>
                  </div>
                      <div class="col-md-4">
                      <div class="form-group">
                          <label>City*</label>
                          <select class="form-control" id="permanent_city">
                           
                          </select>
                      </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Pincode</label>
                              <input type="text" class="form-control"  id="permanent_pincode" placeholder="" value="${
                                  datavalue.permanent_pincode != null
                                      ? datavalue.permanent_pincode
                                      : ""
                              }">
                          </div>
                          </div>
          
      </div>`;
    }
    async personaldetails_family() {
        return `<div class="row" >
        <table class="table">
          <thead>
              <tr>                                
                  <td>Name</td>
                  <td>Relationship</td>
                  <td>Age</td>
                  <td>Education</td>
                  <td>Occuption</td>
                  <td>Action</td>
              </tr>
          </thead>
          <tbody id="TextBoxContainer">
                  <tr>                                
                          <td><input type="text" class="form-control names"  placeholder="Name"></td>
                          <td><input type="text" class="form-control relationship" placeholder="Relationship"></td>
                          <td><input type="text" class="form-control age"     placeholder="Age"></td>
                          <td><input type="text" class="form-control education" placeholder="Education"></td>
                          <td><input type="text" class="form-control occuption" placeholder="Occuption"></td>
                          <td><span><i class="fa fa-plus plusevent" aria-hidden="true"></i></span></td>
                  </tr>
          </tbody>               
          </table>    
      </div>`;
    }
    async personaldetails(data) {
        let self = this;
        return `<ul class="nav nav-tabs" >
        <li class="active"><a class="nav-item nav-link" data-toggle="tab" href="#basic">Basic</a></li>
          <li><a class="nav-item nav-link" data-toggle="tab" href="#contact">Contact Details</a></li>
            <li> <a  class="nav-item nav-link" data-toggle="tab" href="#Address">Address Details</a></li>
              <li><a class="nav-item nav-link" data-toggle="tab" href="#Family">Family Details</a></li>
              <li><a class="nav-item nav-link" data-toggle="tab" href="#languages">Language Details</a></li>
              <li><a class="nav-item nav-link" data-toggle="tab" href="#files">Other Details</a></li>
      </ul>              
    <div class="tab-content">
      <div id="basic"  class="tab-pane fade in active" >  
            ${await self.personaldetails_basic()}
            <div class="modal-footer">                
            <span id="error" style="color: red;font-size:14px"></span>
            <span id="success" style="color:gray;font-size:14px"></span><button type="button" class="btn btn-primary" id="personal_basic">Save Basic Details</button>
          </div>           
      </div> 
      <div id="contact" class="tab-pane fade" >  
            ${await self.personaldetails_contact()}
            <div class="modal-footer">                
            <span id="error" style="color: red;font-size:14px"></span>
            <span id="success" style="color:gray;font-size:14px"></span><button type="button" class="btn btn-primary" id="personal_contact">Save Contact Details</button>
          </div>
      </div>
      <div class="tab-pane fade"  id="Address">      
            ${await self.pesonaldetails_address()}         
            <div class="modal-footer">                
            <span id="error" style="color: red;font-size:14px"></span>
            <span id="success" style="color:gray;font-size:14px"></span><button type="button" class="btn btn-primary" id="personal_address">Save Address Details</button>
          </div>
      </div>
      <div class="tab-pane fade" id="Family">    
            ${await self.personaldetails_family()}
            <div class="modal-footer">                
            <span id="error" style="color: red;font-size:14px"></span>
            <span id="success" style="color:gray;font-size:14px"></span><button type="button" class="btn btn-primary" id="personal_family">Save family Details</button>
          </div>
      </div> 
      <div class="tab-pane fade" id="languages">    
        <div id="languagehtml">
            <div class="row" >
                <div class="col-md-3">
                    <label>Language*</label>
                </div>
                <div class="col-md-3">
                    <label>Proficiency*</label>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Proficiency Details*</label>
                     </div>
                </div>               
            </div>
                ${await self.languagedetails()}            
           </div>
                <div class="row offset-md-6" >
                <input type="text" class="form-control col-md-6" placeholder="Please Enter Language Name*">
                <button style="float:right" class="btn btn-success col-md-6" id="add_language">Add Language</button>
                </div>
         
            <div class="modal-footer">                
            <span id="error" style="color: red;font-size:14px"></span>
            <span id="success" style="color:gray;font-size:14px"></span><button type="button" class="btn btn-primary" id="personal_language">Save Language Details</button>
          </div>   
      </div> 
      <div class="tab-pane fade" id="files">    
        <div class="row" id="bodyfiles">
        <table class="table  table-striped table-bordered">
        <tbody class="file_details">
        ${self.fileuploadhtml(
            "Other",
            "Pan Card",
            "Enter Pancard No",
            "personal",
            "removebtn",
            "",
            "regen",
            "",
            "",
            "",
            ""
        )}      
        </tbody>
        </table>
        </div>
       
                <div class="row offset-md-6">
                <input type="text" class="form-control col-md-6" placeholder="Please Enter File Name*">
                <button  class="btn btn-success col-md-6 add_files" data-filebase="personal" >Add Files</button>
                </div>
      
        <div class="modal-footer">                
        <span id="error" style="color: red;font-size:14px"></span>
        <span id="success" style="color:gray;font-size:14px">
          </div>   
       
      </div>
   </div>  
        `;
    }

    async educationdetails(data) {
        let self = this;
        self.globaldata = await self.globalvariable("globaldata");
        return `<ul class="nav nav-tabs" >
                    <li class="active"><a class="nav-item nav-link" data-toggle="tab" href="#basic">S.S.L.C</a></li>
                    <li><a class="nav-item nav-link" data-toggle="tab" href="#hsc">H.S.C</a></li>
                        <li> <a  class="nav-item nav-link" data-toggle="tab" href="#graduation">Graduation/Diploma</a></li>
                        <li><a class="nav-item nav-link" data-toggle="tab" href="#master">Masters/Post-Graduation</a></li>
                        <li><a class="nav-item nav-link" data-toggle="tab" href="#doctor">Doctorate/PhD</a></li>
                    </ul>
                    <div class="tab-content">
                    <div id="basic"  class="tab-pane fade in active" > 
                  
                    <div class="row">            
                        ${await self.boardtemplate("sslcboard")}           
                        ${await self.datajson(
                            self.globaldata,
                            "year",
                            "Passing Out Year",
                            "passing_out"
                        )}
                        ${await self.datajson(
                            self.globaldata,
                            "schoolmedium",
                            "School Medium",
                            "sslcmedium"
                        )}
                        ${await self.datajson(
                            self.globaldata,
                            "marks",
                            "Total Marks",
                            "sslcmarks"
                        )}
                     </div>    
                        <table class="table  table-striped table-bordered">
                          <tbody class="file_details">                        
                            ${self.fileuploadhtml(
                                "Sslc",
                                "S.S.L.C",
                                "Marksheet",
                                "education",
                                "removebtn",
                                "",
                                "regen",
                                "",
                                "",
                                "addbtn",
                                ""
                            )}    
                            
                          </tbody>
                        </table>    
                        <div class="modal-footer">                
                        <span id="error" style="color: red;font-size:14px"></span>
                        <span id="success" style="color:gray;font-size:14px"></span>
                        <button type="button" class="btn btn-primary" id="education_ssc">Save S.S.L.C Details</button>
                        </div>
                    </div>   
                    <div id="hsc"  class="tab-pane fade" >  
                    <div class="row">            
                        ${await self.boardtemplate("hscboard")}           
                        ${await self.datajson(
                            self.globaldata,
                            "year",
                            "Passing Out Year",
                            "hsc_passing_out"
                        )}
                        ${await self.datajson(
                            self.globaldata,
                            "schoolmedium",
                            "School Medium",
                            "hsc_medium"
                        )}
                        ${await self.datajson(
                            self.globaldata,
                            "marks",
                            "Total Marks",
                            "hsc_marks"
                        )} 
                        <table class="table  table-striped table-bordered">
                        <tbody class="file_details">             
                        
                        ${self.fileuploadhtml(
                            "Hsc",
                            "H.S.C",
                            "Marksheet",
                            "education",
                            "removebtn",
                            "",
                            "regen",
                            "",
                            "",
                            "addbtn",
                            ""
                        )}    
                        <tbody>
                        </table>                       
                    </div>
                    <div class="modal-footer">                
                    <span id="error" style="color: red;font-size:14px"></span>
                    <span id="success" style="color:gray;font-size:14px"></span>
                    <button type="button" class="btn btn-primary" id="education_hsc">Save H.Sec Details</button>
                  </div> 
                    </div>  
                    <div id="graduation"  class="tab-pane fade" >  
                   
                    <div class="row">            
                    ${await self.datajson(
                        self.globaldata,
                        "ugcourse",
                        "Course",
                        "ugcourse"
                    )}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>University/Institute*</label>
                            <input id="university" class="form-control" placeholder="University/Institute">
                    </div></div>
                    ${await self.datajson(
                        self.globaldata,
                        "Specilaization",
                        "Specilaization",
                        "ugspecilaization"
                    )}
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Course Type*</label><br>
                            <label><input type="radio" id="fulltime" name="ugcoursetype" value="FullTime" checked style="margin:10px 2px;"  placeholder="">Full Time</label>
                            <label><input type="radio" id="parttime" name="ugcoursetype" style="margin:10px 2px;" value="PartTime" placeholder="">Part Time</label>
                            <label><input type="radio" id="distance" name="ugcoursetype" style="margin:10px 2px" value="Distance" placeholder="">Distance</label>
                    </div></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Grading System*</label>
                            <select class="form-control" id="uggradingsystem">
                            <option>Scale 10 Grading</option>
                            <option>Scale 4 Grading</option>
                            <option>Percentage of Marks(%)</option>
                            <option>Course Requires a Pass</option>
                            </select>
                    </div></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Marks*</label>
                            <input type="text" class="form-control" id="ugmarks">
                    </div></div>                 
                    <table class="table  table-striped table-bordered">
                    <tbody class="file_details">
                    
                    <tbody>
                    </table>                   
                    </div>
                    <div class="modal-footer">                
                    <span id="error" style="color: red;font-size:14px"></span>
                    <span id="success" style="color:gray;font-size:14px"></span>
                    <button type="button" class="btn btn-primary" id="education_graduation">Save Graduation Details</button>
                  </div> 
                    <div class="row">
                        <ul class="list-inline col-md-12" id="list_of_graduation">
                        
                        </ul>
                    </div>
                    </div>        
                    <div id="master"  class="tab-pane fade" >  
                    <div class="row"> 
                    ${await self.datajson(
                        self.globaldata,
                        "pgcourse",
                        "Course",
                        "pgcourse"
                    )}
                    <div class="col-md-4">
                    <div class="form-group">
                        <label>University/Institute*</label>
                        <input class="form-control" id="pguniversity" placeholder="University/Institute">
                    </div></div>
                    ${await self.datajson(
                        self.globaldata,
                        "Specilaization",
                        "Specilaization",
                        "pgspecilaization"
                    )}

                    <div class="col-md-4">
                    <div class="form-group">
                        <label>Course Type*</label><br>
                        <label><input type="radio" id="fulltime" name="pgcoursetype" value="FullTime" checked style="margin:10px 2px;"  placeholder="">Full Time</label>
                            <label><input type="radio" id="parttime" name="pgcoursetype" style="margin:10px 2px;" value="PartTime" placeholder="">Part Time</label>
                            <label><input type="radio" id="distance" name="pgcoursetype" style="margin:10px 2px" value="Distance" placeholder="">Distance</label>
                    </div></div>
                    <div class="col-md-4">
                    <div class="form-group">
                        <label>Grading System*</label>
                        <select class="form-control" id="pggradingsystem">
                        <option>Scale 10 Grading</option>
                        <option>Scale 4 Grading</option>
                        <option>Percentage of Marks(%)</option>
                        <option>Course Requires a Pass</option>
                        </select>
                    </div></div>
                    <div class="col-md-4">
                    <div class="form-group">
                        <label>Marks*</label>
                        <input type="text" class="form-control" id="pgmarks">
                    </div></div>
                    <table class="table  table-striped table-bordered">
                    <tbody class="file_details">
                  
                    </tbody>
                    </table>
                        </div>
                     <div class="modal-footer">                
                        <span id="error" style="color: red;font-size:14px"></span>
                        <span id="success" style="color:gray;font-size:14px"></span>
                        <button type="button" class="btn btn-primary" id="education_master">Save Master Graduation Details</button>
                      </div>     
                      <div class="row">
                        <ul class="list-inline col-md-12" id="list_of_graduation">
                        
                        </ul>
                    </div>               
                    </div>
                    <div id="doctor"  class="tab-pane fade" >  
                    <div class="row"> 
                        ${await self.datajson(
                            self.globaldata,
                            "doctrate",
                            "Course",
                            "doctorate_course"
                        )}
                        <div class="col-md-4">
                        <div class="form-group">
                            <label>University/Institute*</label>
                            <input class="form-control" id="docuniversity" placeholder="University/Institute">
                        </div></div>
                            ${await self.datajson(
                                self.globaldata,
                                "Specilaization",
                                "Specilaization",
                                "doctorate_specilaization"
                            )}

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Course Type*</label><br>
                                <label><input type="radio" id="fulltime" name="doccoursetype" value="FullTime" checked style="margin:10px 2px;"  placeholder="">Full Time</label>
                            <label><input type="radio" id="parttime" name="doccoursetype" style="margin:10px 2px;" value="PartTime" placeholder="">Part Time</label>
                            <label><input type="radio" id="distance" name="doccoursetype" style="margin:10px 2px" value="Distance" placeholder="">Distance</label>
                                    </div></div>
                         <div class="col-md-4">
                            <div class="form-group">
                                <label>Grading System*</label>
                                <select class="form-control" id="docgradingsystem">
                                <option>Scale 10 Grading</option>
                                <option>Scale 4 Grading</option>
                                <option>Percentage of Marks(%)</option>
                                <option>Course Requires a Pass</option>
                                </select>
                            </div></div>
                            <div class="col-md-4">
                            <div class="form-group">
                                <label>Marks*</label>
                                <input type="text" class="form-control" id="docmarks">
                            </div>
                            </div>
                            </div>     
                            <table class="table  table-striped table-bordered">
                            <tbody class="file_details">
                           
                            </tbody>
                            </table>                              
                   
                    <div class="modal-footer">                
                        <span id="error" style="color: red;font-size:14px"></span>
                        <span id="success" style="color:gray;font-size:14px"></span>
                        <button type="button" class="btn btn-primary" id="education_doctorate">Save Doctorate Details</button>
                    </div> 
                    <div class="row">
                        <ul class="list-inline col-md-12" id="list_of_graduation">
                        
                        </ul>
                    </div>

                </div>
                </div>
                    `;
    }

    async employmenttemplate(response = {}) {
        let self = this;
        let years = ``;
        let month = ``;
        let lakshs = ``;
        let thousands = ``;

        self.globaldata = await self.globalvariable("globaldata");
        if (self.valdateundefined(self.globaldata) != "") {
            years += `<option value=''>Year*</option>`;
            month += `<option value=''>Month*</option>`;
            $.each(self.globaldata.data[0]["year"], function (key, value) {
                years += `<option value=${value}>${value}</option>`;
            });
            $.each(self.globaldata.data[0]["month"], function (key, value) {
                month += `<option value=${value}>${value}</option>`;
            });
            for (let i = 1; i < 100; i++) {
                lakshs += `<option value=${i}>${i} Lacs</option>`;
            }
            for (let i = 5; i < 100; i += 5) {
                thousands += `<option value=${i}>${i} Thousands </option>`;
                i + 5;
            }
        }

        return ` <div class="col-md-4">
                        <label>Your Organization*</label>
                        <input class="form-control" id="organization" placeholder="Your Organization">
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Your Designation*</label>
                            <input class="form-control" id="designation" placeholder="Your Designation">
                        </div>
                    </div>
                        <div class="col-md-4">
                             <div class="form-group">
                                <label>This is your current company ?</label>
                                 <label><input type="radio" style="Margin: 10px;" value="Yes" name="currentcompany_type"> Yes</label><label> <input type="radio" style="Margin: 10px;" name="currentcompany_type" value="No" checked>No </label>
                            </div>
                        </div>
                    <div class="col-md-4">
                       <label>Started Working From *</label>
                       <div class="row">
                            <div class="col-md-6">
                                <select class="form-control" id="workingfrom_year">
                                        ${years}
                                </select>                           
                            </div>
                            <div class="col-md-6">
                                <select class="form-control" id="workingform_date">
                                    ${month}
                                </select>
                            </div>        
                        </div>               
                   </div>
                   <div class="col-md-4">
                   <label>Worked Till*</label>
                   <div class="row">
                        <div class="col-md-6">
                            <select class="form-control" id="till_year">
                                    ${years}
                            </select>                           
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" id="till_month">
                                ${month}
                            </select>
                        </div>        
                    </div>               
               </div>
               <div class="col-md-4" id="currentsalary" style="display:none">
                    <label>Current Salary*</label>
                    <div class="row">
                            <div class="col-md-6">
                                <select class="form-control" id="currentsalary_lacs">
                                        ${lakshs}
                                </select>                           
                            </div>
                            <div class="col-md-6">
                                <select class="form-control" id="currentsalary_thousand">
                                    ${thousands}
                                </select>
                            </div>        
                        </div>    
               </div>
               <div class="col-md-12">
                <div class="form-group">
                    <label>Job Description</label>
                    <textarea class="form-control" placeholder="" id="job_description" placeholder="Job Description..."></textarea>
                </div>
               </div>
              
            `;
    }

    async employmentdetails(data) {
        let self = this;
        return `<ul class="nav nav-tabs" >
        <li class="active"><a class="nav-item nav-link" data-toggle="tab" href="#basic">Add Employment</a></li>
        <li><a class="nav-item nav-link" data-toggle="tab" href="#reference">Reference Details</a></li> 
         </ul>
        <div class="tab-content">
            <div id="basic"  class="tab-pane fade in active" >  
            <div class="row">
                ${await self.employmenttemplate()}
            </div>               
                <table class="table  table-striped table-bordered">
                <tbody class="file_details" id="employmentfiles">
             
                </tbody>
                </table>     
                <div class="modal-footer">                
                <span id="error" style="color: red;font-size:14px"></span>
                <span id="success" style="color:gray;font-size:14px"></span>
                <button type="button" class="btn btn-primary" id="employment_save">Save Employment Details</button>
            </div> 
            <div class="row">
                <ul class="list-inline col-md-12" id="list_of_employment">
                
                </ul>
            </div>
            
            </div> 
            <div id="reference" class="tab-pane fade">
            <table class="table  table-striped table-bordered">
            <thead>
                <tr>                                
                   <td>Organization Name</td>
                   <td>Referencer Name</td>    
                    <td>Reference Designation</td>                                                 
                    <td>Mobile No</td>
                    <td>Email</td>                                                      
                </tr>
            </thead>
            <tbody id="reference_details"> 
            </tbody>                     
            </table>   
            <div class="modal-footer">                
            <span id="error" style="color: red;font-size:14px"></span>
            <span id="success" style="color:gray;font-size:14px"></span>
            <button type="button" class="btn btn-primary" id="reference_save">Save Reference Details</button>
        </div>          
            </div>
        </div>`;
    }
    async skilldetails(data) {
        let self = this;

        return `<ul class="nav nav-tabs" >
        <li class="active"><a class="nav-item nav-link" data-toggle="tab" href="#basic">Apprentice Training Details</a></li>
         <li><a class="nav-item nav-link" data-toggle="tab" href="#computer">Computer Skills</a></li>
         </ul>
        <div class="tab-content">
            <div id="basic"  class="tab-pane fade in active" >  
            <div class="row">
                ${await self.apprenticetemplate()}
            </div>    
            <div class="modal-footer">                
            <span id="error" style="color: red;font-size:14px"></span>
            <span id="success" style="color:gray;font-size:14px"></span>
            <button type="button" class="btn btn-primary" id="save_skills">Save Skill Details</button>
              </div>
              <div class="row">
                    <ul class="list-inline col-md-12" id="list_of_skills">
                    
                    </ul>
                </div>
            </div>
            <div id="computer"  class="tab-pane fade" >  
                <div class="row">
                    ${await self.computerskills()}
                </div>
                <div class="modal-footer">                
                <span id="error" style="color: red;font-size:14px"></span>
                <span id="success" style="color:gray;font-size:14px"></span>
                <button type="button" class="btn btn-primary" id="save_computer_skills">Save Computer Skills</button>
                  </div>
             </div>


        </div>`;
    }
    async computerskills() {
        return `<table class="table  table-striped table-bordered">
        <thead>
            <tr>                                
                
                <td>Computer Knowledge</td>
                <td>Application</td>
                <td>Knowledge</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody id="computer_knowledge">    
      <tr>               
                  <td><select class="form-control cpk">
                      <option value="">Select Option</option>
                      <option value="Mso">MS Office(Word; Excel; Power Point)</option>
                      <option value="erp">ERP</option>
                      <option value="ds">Designing Software</option>
                      <option value="os" >Others, Specify</option>
                    </select></td>
                  <td><input type="text" class="form-control application"></td>
                  <td>
                  <select class="form-control knowledge">
                        <option value="kob">Know only Basic</option>
                        <option value="hws">Has Working Skils</option>
                        <option value="iw">Independently Work</option>
                        <option value="exp">Expert</option>
                  </select>
                  </td>
                  <td><span><i class="fa fa-plus ckplusevent" aria-hidden="true"></i></span></td>
          </tr>                               
        </tbody>               
    </table>`;
    }
    async otherdetails() {
        return `<ul class="nav nav-tabs" >
        <li class="active"><a class="nav-item nav-link" data-toggle="tab" href="#basic">Nash Working Details</a></li>
         <li><a class="nav-item nav-link" data-toggle="tab" href="#strength">Strength/ Weekness</a></li>
         </ul>
        <div class="tab-content">
            <div id="basic"  class="tab-pane fade in active" >  
                <div class="row" style="padding:25px">
                    <label><i class="fa fa-lg fa-arrow-circle-right" aria-hidden="true"></i> Whether attended interview with Nash Industries previously If Yes, give details</label><br>
                    <label><input type="radio" class="checkboxchecked" id="yesid" style="margin: 8px;" value="Yes" name="previous_employee"> Yes</label><label> <input type="radio" style="Margin: 10px;" name="previous_employee" class="checkboxchecked" id="noid" value="No" checked>No </label>
                    <textarea class="form-control" name="previous_employee" style="display:none"></textarea>
                </div>
                <div class="row" style="padding:25px">
                    <label><i class="fa fa-lg fa-arrow-circle-right" aria-hidden="true"></i> Do you have any relatives working in this organization Yes/ No If Yes, give details</label><br>
                    <label><input type="radio" class="checkboxchecked" id="yesid" style="margin: 8px;" value="Yes" name="relative_working"> Yes</label><label> <input type="radio" style="Margin: 10px;" class="checkboxchecked" name="relative_working" value="No" id="noid" checked>No </label>
                    <textarea class="form-control" style="display:none" name="relative_working" ></textarea>
                </div>
                <div class="row" style="padding:25px">
                    <label><i class="fa fa-lg fa-arrow-circle-right" aria-hidden="true"></i> Had you suffered any major illness or were hospitalized for operation. If Yes, give details</label><br>
                    <label><input type="radio" class="checkboxchecked" id="yesid" style="margin: 8px;" value="Yes" name="major_illness"> Yes</label><label> <input type="radio" style="Margin: 10px;" class="checkboxchecked" name="major_illness" value="No" id="noid" checked>No </label>
                    <textarea class="form-control" style="display:none" name="major_illness"></textarea>
                </div>
                <div class="row" style="padding:25px">
                    <label><i class="fa fa-lg fa-arrow-circle-right" aria-hidden="true"></i> Had you ever been convicted by any Court of Law in India Yes/ No If Yes, give details</label><br>
                    <label><input type="radio" class="checkboxchecked" id="yesid" style="margin: 8px;" value="Yes" name="any_court_law"> Yes</label><label> <input type="radio" style="Margin: 10px;" class="checkboxchecked" name="any_court_law" value="No" id="noid" checked>No </label>
                    <textarea class="form-control" style="display:none" name="any_court_law"></textarea>
                </div>       
                <div class="modal-footer">                
                <span id="error" style="color: red;font-size:14px"></span>
                <span id="success" style="color:gray;font-size:14px"></span>
                <button type="button" class="btn btn-primary" id="save_other_details">Save Other Details</button>
                  </div>         

            </div>
            <div id="strength" class="tab-pane fade">
            <div class="row" style="padding:25px">            
            <table class="table  table-striped table-bordered">
                <thead>
                    <tr>         
                        <td>Strength</td>
                        <td>Weekness</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody id="strength_week">    
                    <tr>               
                        <td><textarea class="form-control strengthclass"  placeholder="Strength"></textarea></td>
                        <td><textarea class="form-control weeknessclass" placeholder="Weekness"></textarea></td>
                        <td><button class="btn btn-success strength_add_btn"><i class="fa fa-plus"></i></button></td>                        
                </tr>                               
                </tbody>               
                </table>                
                </div>
                <div class="modal-footer">                
                <span id="error" style="color: red;font-size:14px"></span>
                <span id="success" style="color:gray;font-size:14px"></span>
                <button type="button" class="btn btn-primary" id="save_strength_details">Save Details</button>
                  </div>   
            </div>`;
    }
    async apprenticetemplate(data) {
        let self = this;
        let years = `<option value="">Year</option>`;
        let month = `<option value="">Month</option>`;
        self.globaldata = await self.globalvariable("globaldata");
        $.each(self.globaldata.data[0]["year"], function (key, value) {
            years += `<option value=${value}>${value}</option>`;
        });
        $.each(self.globaldata.data[0]["month"], function (key, value) {
            month += `<option value=${value}>${value}</option>`;
        });
        return `<div class="row">
                    <div class="col-md-4">
                        <label>Programme Type</label>
                        <select class="form-control" id="programme_type">
                        <option value="">Select Programme</option>
                            <option>Apprentice</option>
                            <option>Professional</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                    <label>Programme</label>
                    <input type="text" class="form-control" id="programme_value" placeholder="Programme">
                    </div>
                    <div class="col-md-4">
                    <label>Organization Name</label>
                    <input type="text" class="form-control" id="organization_name" placeholder="Organization">
                    </div>
                    <div class="col-md-4">
                    <label>Started Programme </label>
                    <div class="row">
                            <div class="col-md-6">
                                <select class="form-control" id="start_year">
                                        ${years}
                                </select>                           
                            </div>
                            <div class="col-md-6">
                                <select class="form-control" id="start_month">
                                    ${month}
                                </select>
                            </div>        
                        </div>    
                    </div>
                    <div class="col-md-4">
                    <label>Ended Programme </label>
                    <div class="row">
                            <div class="col-md-6">
                                <select class="form-control" id="end_year">
                                        ${years}
                                </select>                           
                            </div>
                            <div class="col-md-6">
                                <select class="form-control" id="end_month">
                                    ${month}
                                </select>
                            </div>        
                        </div>    
                    </div>
                </div>`;
    }

    async boardtemplate(ids = "") {
        return `<div class="col-md-4">                        
        <div class="form-group">
          <label>Board</label>
          <select class="form-control" id="${ids}">
        <option value="">Select Board</option>
        <optgroup label="-----All India-----">
            <option value="CBSE"> CBSE </option>
            <option value="CISCE(ICSE/ISC)"> CISCE(ICSE/ISC)</option> 
            <option value="Diploma"> Diploma </option>
            <option value="National Open School"> National Open School </option>
            <option value="IB(International Baccalaureate)"> IB(International Baccalaureate)</option> 
        </optgroup >                       
        <optgroup label="-----State Boards-----">
            <option value="Andhra Pradesh "> Andhra Pradesh </option>
            <option value="Assam "> Assam </option>
            <option value="Bihar "> Bihar </option>
            <option value="Goa "> Goa </option>
            <option value="Gujarat "> Gujarat </option>
            <option value="Haryana "> Haryana </option>
            <option value="Himachal Pradesh "> Himachal Pradesh </option>
            <option value="J &amp; K "> J &amp; K </option>
            <option value="Karnataka "> Karnataka </option>
            <option value="Kerala "> Kerala </option>
            <option value="Maharashtra "> Maharashtra </option>
            <option value="Madhya Pradesh "> Madhya Pradesh </option>
            <option value="Manipur "> Manipur </option>
            <option value="Meghalaya "> Meghalaya </option>
            <option value="Mizoram "> Mizoram </option>
            <option value="Nagaland "> Nagaland </option>
            <option value="Orissa "> Orissa </option>
            <option value="Punjab "> Punjab </option>
            <option value="Rajasthan "> Rajasthan </option>
            <option value="Tamil Nadu "> Tamil Nadu </option>
            <option value="Tripura "> Tripura </option>
            <option value="Uttar Pradesh "> Uttar Pradesh </option>
            <option value="West Bengal "> West Bengal </option>
            <option value="Other "> Other </option>
        </optgroup>
      </select></div>
      </div>`;
    }

    fileuploadhtml(
        basename = "",
        filename = "",
        placeholder = "",
        filebase = "",
        removebtn = "",
        deletebtnid = "",
        regen = "",
        downloadhref = "",
        savebtn = "",
        addbtn = "",
        confirmbtn = ""
    ) {
        let removebtntd = "";
        if (removebtn != "") {
            removebtntd = `<td>
            <button value="1" data-regen="${regen}" class="btn btn-primary removebtn"><i class="fa fa-times" aria-hidden="true"></i></button>
           </td>`;
        }
        let deletebtntd = "";
        if (deletebtnid != "") {
            deletebtntd = `<td>
            <button  data-deletebtn="${deletebtnid}"  data-regen="${regen}" class="btn btn-primary deletebtn"><i class="fa fa-trash" aria-hidden="true"></i></button>
           </td>`;
        }
        let downloadbtntd = ``;
        if (downloadhref == "") {
            downloadbtntd = `<td>
            <button class="btn btn-primary downloadbtn" disabled><i class="fa fa-download" aria-hidden="true" disabled></i></button>
           </td>`;
        } else {
            downloadbtntd = `<td>
            <a href="${downloadhref}" target="_blank"><button class="btn btn-primary downloadbtn" ><i class="fa fa-download" aria-hidden="true"></i></button></a>
           </td>`;
        }
        let savebtnval = `<td><button class="btn btn-primary savedetails" data-ids="${filebase}" ${
            savebtn != "" ? "disabled" : ""
        }>save</button></td>`;
        let addbtntd = "";
        if (addbtn != "") {
            addbtntd = `<td><button class="btn btn-primary eduaddbtn" data-ids="${deletebtnid}"><i class="fa fa-plus"></i></button></td>`;
        }
        let confirmbtntd = "";
        if (confirmbtn == "" || confirmbtn == 0) {
            confirmbtntd = `<td><button class="btn btn-primary confirmbtn"  data-confirmid="${deletebtnid}" style="border-radius: 360px;" ${
                deletebtnid == "" ? "disabled" : ""
            }>
            <i class="fa fa-check" aria-hidden="true"></i></button>
            <span style="font-size: 9px;">Not Verfied</span></td>`;
        } else {
            confirmbtntd = `<td><button class="btn btn-warning"style="border-radius: 360px;">
            <i class="fa fa-check" aria-hidden="true"></i></button>
            <span style="font-size: 9px;">Verfied</span></td>`;
        }

        return `
        <tr>    
       
        <td><input type="text" class="form-control filenames"  data-basename="${basename}" value="${filename}" readonly></td>
        <td><input type="text" class="form-control filedescription" value="" placeholder="${
            placeholder == "" ? "File Description" : placeholder
        }"></td>
     
        <td>
        <input name="file-upload-field" type="file" class="file-upload-field btn btn-success col-md-12" value=""></td>
                ${savebtnval}
                ${removebtntd}
                ${deletebtntd}
                ${downloadbtntd}
                ${addbtntd}  
                ${confirmbtntd}  
             
        </tr>`;
    }
    async languagetemplate(title = "", ids, removebtn = "", mothertongue = "") {
        if (removebtn != "") {
            removebtn = `<div class="col-md-2">
                    <button class="btn btn-success remove" ><i class="fa fa-trash"></i></button>
                    </div>`;
        }
        if (mothertongue != "") {
            mothertongue = `<select class="form-control inputselect">                        
                            <option>Mother Tongue</option>                         
                        </select>`;
        } else {
            mothertongue = `<select class="form-control inputselect">
                              <option>Beginner</option>
                               <option>Proficient</option>
                                <option>Expert</option>
                             </select>`;
        }

        return ` <div class="row" id="${ids}">
                    <div class="col-md-3">
                        <input type="text"  value="${title}" class="form-control inputtext" placeholder="${
            title == "" ? "Enter Mother Tongue" : ""
        }">    
                    </div>
                    <div class="col-md-3">
                        ${mothertongue}                
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="Checkbox" style="margin: 12px 10px;-webkit-transform: scale(1.5);" class="inputread">Read <input style="margin: 12px 10px;-webkit-transform: scale(1.5);" type="Checkbox" class="inputwrite">Write <input style="margin:12px 10px;-webkit-transform: scale(1.5);" type="Checkbox" class="inputspeak">Speak
                        </div>
                    </div>
                    ${removebtn}
                </div>`;
    }

    async languagedetails(data) {
        let self = this;
        let languagetemp = await self.languagetemplate(
            "",
            "add_mothertongue",
            "",
            "mothertongue"
        );
        languagetemp += await self.languagetemplate("English", "add_english");
        return `${languagetemp}`;
    }

    async datajson(res, primary, title, ids) {
        let self = this;

        let years = `<div class="col-md-4"><div class="form-group"><label>${title}</label>
        <select id=${ids} class="form-control"><option value="">Select ${title}</option>`;
        $.each(res.data[0][primary], function (key, value) {
            years += `<option value=${value}>${value}</option>`;
        });
        years += `</select></div></div>`;
        return years;
    }

    datepickers() {
        $(".datepicker").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            yearRange: "1972:2020",
        });
    }
    anniversarydate(value) {
        return `<div class="form-group">
        <label>Anniversary Date</label>
        <input type="text" class="form-control datepicker" id="anniversarydate"  placeholder=" " >
      </div>`;
    }
    differntalyable(value) {
        return ` <div class="form-group">
        <label>Differently Abled Type</label>
        <select class="form-control" id="differently_abled_type">
          <option value=""> Select Type * </option>
          <option value="BN"> Blindness </option>
          <option value="LV"> Low Vision </option>
          <option value="HI"> Hearing Impairment </option>
          <option value="SLD"> Speech and Language Disability </option>
          <option value="LD"> Locomotor Disability </option>
          <option value="LCP"> Leprosy Cured Person </option>
          <option value="CP"> Cerebral Palsy </option>
          <option value="Dm"> Dwarfism </option>
          <option value="MD"> Muscular Dystrophy </option>
          <option value="AAV"> Acid Attack Victims </option>
          <option value="SLD"> Specific Learning Disabilities </option>
          <option value="ASD"> Autism Spectrum Disorder </option>
          <option value="MI"> Mental Illness </option>
          <option value="Ha"> Haemophilia </option>
          <option value="SCD"> Sickle Cell Disease </option>
          <option value="Ta"> Thalassemia </option>
          <option value="PD"> Parkinson's Disease </option>
          <option value="ID"> Intellectual Disability </option>
          <option value="CNC"> Chronic Neurological Conditions </option>
          <option value="MS"> Multiple Sclerosis </option>
          <option value="MDDBN"> Multiple Disabilities including Deaf Blindness </option>
          <option value="Others"> Others </option>
        </select></div>`;
    }
    differently_abled_type(value) {
        return `<div class="form-group">
        <label>Need any assistance at workplace?</label>
        <textarea class="form-control"></textarea>
      </div>  `;
    }
    GetDynamicTextBox(value) {
        return `<tr><td><input type="text" class="form-control names"  placeholder="Name"></td>
                       <td><input type="text" class="form-control relationship"  placeholder="Relationship"></td>
                       <td><input type="text" class="form-control age"   placeholder="Age"></td>
                       <td><input type="text" class="form-control education" placeholder="Education"></td>
                       <td><input type="text" class="form-control occuption"   placeholder="Occuption"></td>
                       <td><span><i class="fa fa-plus plusevent" aria-hidden="true"></i></span><span><i class="fa fa-trash removeevent" aria-hidden="true"></i></span></td>
               </tr>`;
    }
    computerknowledge(value) {
        return `<tr>            <td><select class="form-control cpk"><option value="">Select Option</option> <option value="Mso">MS Office(Word; Excel; Power Point)</option>
                                              <option value="erp">ERP</option>
                                              <option value="ds">Designing Software</option>
                                              <option value="os" >Others, Specify</option></select></td>
                                          <td><input type="text" class="form-control application"></td>
                                          <td>
                                          <select class="form-control knowledge">
                                                <option value="kob">Know only Basic</option>
                                                <option value="hws">Has Working Skils</option>
                                                <option value="iw">Independently Work</option>
                                                <option value="exp">Expert</option>
                                          </select>
                                          </td>
                                          <td><span><i class="fa fa-plus ckplusevent" aria-hidden="true"></i></span><span><i class="fa fa-trash ckevent" aria-hidden="true"></i></span></td>
                                  </tr>    `;
    }
    successmethod(parentid, msg) {
        $("#" + parentid)
            .find("#success")
            .html(msg);
    }
    errormethod(parentid, childid, msg) {
        $("#" + parentid)
            .find("#error")
            .html(msg + "*");
        $("#" + parentid)
            .find("#" + childid)
            .focus();
        return false;
    }
    async personalBasicsave(data) {
        return await axios.post(
            `${this.url}joiningform/savepersonalbasic`,
            data
        );
    }
    async educationsave(data) {
        return await axios.post(`${this.url}joiningform/educationsave`, data);
    }
    async educationsavedetails() {
        let self = this;
        let temp_empid = self.P_B_DB.id;
        return await axios.get(
            `${this.url}joiningform/geteducationdetails/` + temp_empid
        );
    }

    async filedetailsstored(data) {
        return await axios.post(`${this.url}joiningform/savefiledetails`, data);
    }
    async profilefilestored(data) {
        return await axios.post(`${this.url}joiningform/saveprofiledet`, data);
    }
    async getpersonaldetails() {
        let self = this;
        let temp_empid = self.P_B_DB.id;
        return await axios.get(
            `${this.url}joiningform/getpersonaldetails/` + temp_empid
        );
    }
    async deletefiles(file_id, temp_empid) {
        let self = this;
        return await axios.get(
            `${this.url}joiningform/deletefiles/` + file_id + "/" + temp_empid
        );
    }
    async verifiedfiles(file_id, temp_empid) {
        let self = this;
        return await axios.get(
            `${this.url}joiningform/employeeverfied/` +
                file_id +
                "/" +
                temp_empid
        );
    }

    async databasesavefile(temp_empid, file_base_path) {
        let self = this;
        return await axios.get(
            `${this.url}joiningform/getfiledetails/` +
                temp_empid +
                "/" +
                file_base_path
        );
    }
    async joiningstatelist(thisvalue) {
        return await axios.get(`${this.url}joiningform/statelist/` + thisvalue);
    }
    async joiningcitylist(thisvalue) {
        return await axios.get(`${this.url}joiningform/citylist/` + thisvalue);
    }
    async getemployeefiles(id) {
        return await axios.get(`${this.url}joiningform/getemployeefiles/` + id);
    }

    //joiningform/getmaillink/"+tempid
}
class joiningindex extends globalclass {
    constructor() {
        super();
        this.defaultmethod();
        this.datepickers();
    }
    defaultmethod() {
        let self = this;
        $("input").attr("autocomplete", "off");
        $(".saveemployee").on("click", async function (e) {
            let parentid = $("#joiningform");
            parentid.find("#error").html("");
            parentid.find("#success").html("");
            let data = {};
            if (parentid.find("#name").val() == "") {
                return self.errormethod(
                    "joiningform",
                    "name",
                    "Please check the name"
                );
            } else if (parentid.find("#emailid").val() == "") {
                return self.errormethod(
                    "joiningform",
                    "emailid",
                    "Please check the email"
                );
            } else if (parentid.find("#joininglocation").val() == "") {
                return self.errormethod(
                    "joiningform",
                    "joininglocation",
                    "Please check the joininglocation"
                );
            } else if (parentid.find("#department").val() == "") {
                return self.errormethod(
                    "joiningform",
                    "department",
                    "Please check the department"
                );
            } else if (parentid.find("#designation").val() == "") {
                return self.errormethod(
                    "joiningform",
                    "designation",
                    "Please check the designation"
                );
            } else if (parentid.find("#interviewdate").val() == "") {
                return self.errormethod(
                    "joiningform",
                    "interviewdate",
                    "Please check the interviewdate"
                );
            } else if (parentid.find("#interviewjoining").val() == "") {
                return self.errormethod(
                    "joiningform",
                    "interviewjoining",
                    "Please check the interviewjoining"
                );
            } else {
                data.name = parentid.find("#name").val();
                data.email_id = parentid.find("#emailid").val();
                data.joininglocation = parentid.find("#joininglocation").val();
                data.department = parentid.find("#department").val();
                data.designation = parentid.find("#designation").val();
                data.date_of_interview = parentid.find("#interviewdate").val();
                data.date_of_joining = parentid.find("#interviewjoining").val();
                let storedet = await self.saveemployee(data);
                if (storedet.status == "200") {
                    self.successmethod(
                        "joiningform",
                        "Employee Successfully Added"
                    );
                    parentid.find("#name").val("");
                    parentid.find("#emailid").val("");
                }
            }
        });
        $("body").on("click", ".mailcopylink", async function () {
            let thisid = $(this).attr("id");
            let maillink = await self.getmaillink(thisid);
            if (maillink.status == 200) {
                let idstatus = maillink.data;
                console.log(idstatus);
                let link = `<div class="card"><div class="card-body">
                                ${self.url}enrollform/${idstatus}</div></div>`;
                $("#maillink").find(".modal-body").html(link);
                $("#maillink").modal("show");
            }
        });
        $("body").on("change", "#joininglocation", async function (e) {
            e.preventDefault();
            let thisvalue = $(this).val();
            let plantdetails = await self.getplant(thisvalue);
            //console.log(plantdetails);
            let departmentoption = `<option value="">Select department</option>`;
            if (plantdetails.status == 200) {
                if (plantdetails.data.department != undefined) {
                    $.each(plantdetails.data.department, function (key, val) {
                        departmentoption += `<option value=${val.deptcode}>${val.deptname}</option>`;
                    });
                }
            }
            $("#department").html(departmentoption);
        });

        $("body").on("click", ".checklistmodel", async function (e) {
            e.preventDefault();
            let thisid = $(this).attr("id");
            let employeefiles = await self.getemployeefiles(thisid);
            if (employeefiles.status == 200) {
                self.employeefiles = employeefiles.data.details;
                if (self.employeefiles.length > 0) {
                    $("#CheckListModal").find(".modal-body").html("");
                    let personal = "";
                    let education = "";
                    let employement = "";
                    $.each(self.employeefiles, function (key, value) {
                        let hreflink = `${self.url}storage/HrFiles/${value.file_path}`;
                        let verifiedbtn = ``;
                        if (value.hr_verified_status == 0) {
                            verifiedbtn = `<td>
                            <button class="btn btn-primary hrconfirmbtn" data-tempid ="${thisid}" data-fileid="${value.id}"  style="border-radius: 360px;">
                            <i class="fa fa-check" aria-hidden="true"></i></button><br>
                            <span style="font-size: 9px;">Not Verfied</span></td>`;
                        } else {
                            verifiedbtn = `<td>
                            <button class="btn btn-warning"   style="border-radius: 360px;">
                            <i class="fa fa-check" aria-hidden="true"></i></button><br>
                            <span style="font-size: 9px;">Verfied</span></td>`;
                        }
                        if (value.file_base_path == "personal") {
                            personal += `<tr>
                                        <td>${value.file_name}</td>
                                        <td>${value.file_description}</td>
                                        <td><a href="${hreflink}" target="_blank"><button class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i></button></a></td>
                                        ${verifiedbtn}
                                        </tr>`;
                        }
                        if (value.file_base_path == "education") {
                            education += `<tr>
                                        <td>${value.file_name}</td>
                                        <td>${value.file_description}</td>
                                        <td><a href="${hreflink}" target="_blank"><button class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i></button></a></td>
                                        ${verifiedbtn}
                                        </tr>`;
                        }
                        if (value.file_base_path == "previousemployee") {
                            employement += `<tr>
                                        <td>${value.file_name}</td>
                                        <td>${value.file_description}</td>
                                        <td><a href="${hreflink}" target="_blank"><button class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i></button></a></td>
                                        ${verifiedbtn}
                                        </tr>`;
                        }
                    });
                    let pesonalhtml = `
                    <table class="table table-borderless">
                    <thead>
                    <tr>
                    <th>File Name</th>
                    <th>File Description</th>
                    <th>Download File</th>
                    <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                            ${personal}
                            ${education}
                            ${employement}
                    </tbody>
                    </table>`;
                    $("#CheckListModal").find(".modal-body").html(pesonalhtml);
                    $("#CheckListModal").modal("show");
                } else {
                    let htmldiv = `<div class="form-group" style="text-align: center;font-size: 22px;"> 
                            <label> Employee didn't update any files</label>
                        </div>
                        <div class="form-group" style="text-align: center;font-size: 22px;"> 
                            <label> OR</label>
                        </div>
                        <div class="form-group" style="text-align: center;font-size: 22px;"> 
                            <label> Doesn't verify the files</label>
                        </div> `;

                    $("#CheckListModal").find(".modal-body").html(htmldiv);
                    $("#CheckListModal").modal("show");
                }
            }
        });
        $("body").on("click", ".hrconfirmbtn", async function (e) {
            e.preventDefault();
            $(this).removeClass("btn btn-primary hrconfirmbtn");
            $(this).addClass("btn btn-warning hrverifiedbtn");

            $(this)
                .closest("td")
                .find("span")
                .html(`Click again for confirmation`);
        });
        $("body").on("click", ".hrverifiedbtn", async function (e) {
            e.preventDefault();

            let confirmid = $(this).data("fileid");
            let tempid = $(this).data("tempid");
            let verifiedstatus = await self.hrverifiedfiles(confirmid, tempid);
            if (verifiedstatus.status == 200) {
                $(this).closest("td").find("span").text("Verified");
            }
        });
    }

    async getplant(data) {
        let self = this;
        return await axios.get(`${this.url}joiningform/getplant/` + data);
    }
    async getemployeefiles(id) {
        return await axios.get(`${this.url}joiningform/getemployeefiles/` + id);
    }
    async saveemployee(data) {
        let self = this;
        return await axios.post(`${this.url}/joiningform/uploademployee`, data);
    }
    async hrverifiedfiles(file_id, temp_empid) {
        let self = this;
        return await axios.get(
            `${this.url}joiningform/hrverfied/` + file_id + "/" + temp_empid
        );
    }
    successmethod(parentid, msg) {
        $("#" + parentid)
            .find("#success")
            .html(msg);
    }
    errormethod(parentid, childid, msg) {
        $("#" + parentid)
            .find("#error")
            .html(msg + "*");
        $("#" + parentid)
            .find("#" + childid)
            .focus();
        return false;
    }
    // await addjoingform(data){

    // }

    datepickers() {
        $(".datepicker").datepicker({ dateFormat: "yy-mm-dd" });
    }
    async getmaillink(id) {
        let self = this;
        return await axios.get(`${self.url}joiningform/getmaillink/${id}`);
    }
}

class resignerindex extends globalclass {
    constructor() {
        super();
        this.defaultmethod();
        this.datepickers();
    }
    defaultmethod() {
        let self = this;
        $("body").on("change", "#plant", async function (e) {
            e.preventDefault();
            let thisvalue = $(this).val();
            let plantdetails = await self.getplant(thisvalue);
            //console.log(plantdetails);
            let departmentoption = `<option value="">Select department</option>`;
            if (plantdetails.status == 200) {
                if (plantdetails.data.department != undefined) {
                    $.each(plantdetails.data.department, function (key, val) {
                        departmentoption += `<option value=${val.deptcode}>${val.deptname}</option>`;
                    });
                }
            }
            $("#department").html(departmentoption);
        });
        $("body").on("click", ".saveresigner", async function (e) {
            e.preventDefault();
            let parentid = $("#resigner_form");
            let idelement = [
                { id: "name", label: "Name", required: 1 },
                { id: "empcode", label: "Employee Code*", required: 0 },
                { id: "plant", label: "Plant", required: 0 },
                { id: "department", label: "Department", required: 1 },
                {
                    id: "resigned_date",
                    label: "Resignation Date",
                    required: 1,
                },
                {
                    id: "reason_for_resigned",
                    label: "Resigned Reason",
                    required: 1,
                },
            ];
            let process = 0;
            let data = {};
            $.each(idelement, function (key, value) {
                if (
                    parentid.find(`#${value.id}`).val() == "" &&
                    value.required == 1
                ) {
                    process = 0;
                    return self.errormethod(
                        "resigner_form",
                        value.id,
                        `Please Check the ${value.label}`
                    );
                } else {
                    process = 1;
                    data[value.id] = parentid.find(`#${value.id}`).val();
                }
            });
            if (process == 1) {
                let saveresigning = await self.saveresigning(data);

                if (saveresigning.status == "200") {
                    self.successmethod(
                        "resigner_form",
                        "Resigning Employee Details Added Successfully"
                    );
                }
            }

            // console.log(data);
        });
    }
    async getplant(data) {
        let self = this;
        return await axios.get(`${self.url}joiningform/getplant/` + data);
    }
    async saveresigning(data) {
        let self = this;
        return await axios.post(`${self.url}resignerlist/saveresigner`, data);
    }
}
