function checkpersonal(){
    return true;
}
$(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
        $('body').on('click',"#save_personal_details",function(e){
                        e.preventDefault();             
                        var tempid = $("#temp_id").val();
                        var data = {};
                        data.name = $("#name").val();
                        data.date_birth = $("#date_birth").val();
                        data.blood_group = $("#blood_group").val();
                        data.Mobile_no = $("#Mobile_no").val();
                        data.Mobile_no_secondary = $("#Mobile_no_secondary").val();
                        data.present_address = $("#present_address").val(); 
                        data.email = $("#email").val();
                        data.gender = $("#gender").val();
                        data.martial_status = $("#martial_status").val();
                        data.religion = $("#religion").val();
                        data.language_known = $("#language_known").val();
                        data.permanent_address = $("#permanent_address").val();
                        var secondary_data = {};
                        secondary_data.type_of = 'Family';
                        secondary_data.temp_empid = $("#temp_id").val();
                        secondary_data.employee_details =[];
                        $("#TextBoxContainer > tr").each(function(index,tr){                         
                                var temp = {};
                                temp.name = $(this).find(".names").val();
                                temp.relationship = $(this).find(".relationship").val();
                                temp.age = $(this).find(".age").val();
                                temp.education = $(this).find(".education").val();
                                temp.occuption = $(this).find(".occuption").val();
                                if(temp.name != '' && temp.name != null){
                                    secondary_data.employee_details.push(temp);
                                }                
                        });
                        if(secondary_data.employee_details.length == 0){
                            secondary_data = null;
                        }
                        if(checkpersonal(data)){                  
                            $.ajax({
                            type:'POST',
                            url:'storepersonaldetail',
                            data:{primary:data,secondary:secondary_data,tempid:tempid,type_of:'Family'},
                            success:function(res){
                                if(res.Success == 'Success'){
                                    $.message({
                                            type: "success",
                                            text: "Successfully updated",
                                            duration: 5000,
                                            positon: "top-center",
                                            showClose: true
                                    });
                                }

                            }
                            });
                        }        
    });
    $('body').on('click',"#save_education_details",function(e){
                    e.preventDefault();             
                    var tempid = $("#temp_id").val();
                    var secondary_data = {};
                    secondary_data.type_of = 'Education';
                    secondary_data.temp_empid = $("#temp_id").val();
                    secondary_data.employee_details ={};
                    secondary_data.employee_details['education'] =[]; 
                    secondary_data.employee_details['training'] =[]; 
                    secondary_data.employee_details['computer'] =[];                     
                    $("#education_details > tr").each(function(index,tr){                         
                        var temp = {};
                        temp.course = $(this).find(".course").val();
                        temp.subject = $(this).find(".subject").val();
                        temp.institute = $(this).find(".institute").val();
                        temp.duration = $(this).find(".duration").val();
                        temp.passing = $(this).find(".passing").val();
                        temp.cgpa = $(this).find(".cgpa").val();                        
                        if(temp.course != '' && temp.course != null){
                            secondary_data.employee_details['education'].push(temp);
                        }                
                    });
                    $("#training_details > tr").each(function(index,tr){                         
                        var temp = {};
                        temp.training = $(this).find(".training").val();
                        temp.programme = $(this).find(".programme").val();
                        temp.institute = $(this).find(".institute").val();
                        temp.duration = $(this).find(".duration").val();                                              
                        if(temp.training != '' && temp.training != null){
                            secondary_data.employee_details['training'].push(temp);
                        }                
                    });
                    $("#computer_knowledge > tr").each(function(index,tr){                         
                        var temp = {};
                        temp.cpk = $(this).find(".cpk").val();
                        temp.application = $(this).find(".application").val();
                        temp.knowledge = $(this).find(".knowledge").val();                                                               
                        if(temp.cpk != '' && temp.cpk != null){
                            secondary_data.employee_details['computer'].push(temp);
                        }                
                    });
                   
                    
                    if(secondary_data.employee_details.education.length == 0 && secondary_data.employee_details.training.length == 0 && secondary_data.employee_details.computer.length == 0){
                        secondary_data = null;                        
                    }    
                    // }else{
                    //     console.log(secondary_data.employee_details);
                    //     secondary_data.employee_details = JSON.stringify(secondary_data.employee_details);
                    // }
                    if(checkpersonal(secondary_data)){                  
                        $.ajax({
                            type:'POST',
                            url:'storepersonaldetail',
                            dataType:'json',
                            data:{secondary:secondary_data,tempid:tempid,type_of:'Education'},
                            success:function(res){
                            if(res.Success == 'Success'){
                                $.message({
                                type: "success",
                                text: "Successfully updated",
                                duration: 5000,
                                positon: "top-center",
                                showClose: true
                                });
                            }

                        }
                        });
                    }
    });
    $('body').on('click',"#save_employment_details",function(e){
                e.preventDefault();             
                var tempid = $("#temp_id").val();
                var data = {};
                var secondary_data = {};
                        secondary_data.type_of = 'employment';
                        secondary_data.temp_empid = $("#temp_id").val();
                        secondary_data.employee_details =[];
                $("#employment_details > tr").each(function(index,tr){                         
                        var temp = {};
                        temp.organziation = $(this).find(".organziation").val();
                        temp.designation = $(this).find(".designation").val();
                        temp.workperiod = $(this).find(".workperiod").val();
                        temp.duration = $(this).find(".duration").val();
                        temp.description = $(this).find(".description").val();
                        temp.grosssalary = $(this).find(".grosssalary").val();                        
                        if(temp.organziation != '' && temp.organziation != null){
                            secondary_data.employee_details.push(temp);
                        }     
                });
                data.basic_cs_mon = $("#basic_cs_mon").val();
                data.basic_cs_ann = $("#basic_cs_ann").val();
                data.da_cs_mon = $("#da_cs_mon").val();
                data.da_cs_ann = $("#da_cs_ann").val();
                data.allowance_cs_mon = $("#allowance_cs_mon").val();
                data.allowance_cs_ann = $("#allowance_cs_ann").val();
                data.monthlygross_cs_mon = $("#monthlygross_cs_mon").val();
                data.monthlygross_cs_ann = $("#monthlygross_cs_ann").val();
                data.annualbene_cs_mon = $("#annualbene_cs_mon").val();
                data.annualbene_cs_ann = $("#annualbene_cs_ann").val();
                data.others_cs_mon = $("#others_cs_mon").val();
                data.others_cs_ann = $("#others_cs_ann").val();
                if(checkpersonal(data)){                  
                        $.ajax({
                            type:'POST',
                            url:'storepersonaldetail',
                            dataType:'json',
                            data:{primary:data,secondary:secondary_data,tempid:tempid,type_of:'employment'},
                            success:function(res){
                            if(res.Success == 'Success'){
                                $.message({
                                type: "success",
                                text: "Successfully updated",
                                duration: 5000,
                                positon: "top-center",
                                showClose: true
                                });
                            }

                        }
                        });
                    }
    });
    $('body').on('click','#save_other_information',function(e){
                e.preventDefault();             
                var tempid = $("#temp_id").val();
                var data = {};
                $('#otherscheckevent').find(".checkboxchecked").each(function(){                   
                    if($(this).is(":checked")){  
                        var idinfo = $(this).attr('id');                       
                        data[idinfo] = 'Yes';                        
                        var extrainfo = $(this).attr('id')+'_details';
                        if($("#"+extrainfo).val() != ''){
                            data[extrainfo] = $("#"+extrainfo).val();
                        }                        
                    }
                    else if($(this).is(":not(:checked)")){
                        var idinfo = $(this).attr('id');
                        console.log(idinfo);
                        data[idinfo] = 'No';                      
                    }
                });
                if(checkpersonal(data)){                  
                        $.ajax({
                            type:'POST',
                            url:'storepersonaldetail',
                            dataType:'json',
                            data:{primary:data,tempid:tempid,type_of:'others'},
                            success:function(res){
                            if(res.Success == 'Success'){
                                $.message({
                                type: "success",
                                text: "Successfully updated",
                                duration: 5000,
                                positon: "top-center",
                                showClose: true
                                });
                            }

                        }
                        });
                    }                

    });
    $('body').on('click','#save_filedetails',function(e){
                e.preventDefault();             
                var tempid = $("#temp_id").val();                
                let formData = new FormData();
                let file = $(this).closest('tr').find('input[type=file]')[0].files[0];
                let filename = $(this).closest('tr').find('#file_name_detail').val();
                formData.append('tempid',tempid);
                formData.append('filename', filename);
                formData.append('file', file, file.name);
                formData.append('type','personalfiles');
                $.ajax({
                url: 'storefiledetail',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',   
                contentType: false,
                processData: false,   
                cache: false,        
                data: formData,
                success: function(res) {
                    if(res.Success == 'Success'){
                                    $.message({
                                            type: "success",
                                            text: "Successfully updated",
                                            duration: 5000,
                                            positon: "top-center",
                                            showClose: true
                                    });
                                }
                },
                error: function(data) {
                    console.log(data);
                }
            });
    });
    
    $('.datepicker').datepicker({ 
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true,   
                    yearRange: "1960:"
    });
    $(":input").inputmask();
    $('#dob').on('change', function(ev){
                    $(this).datepicker('hide');
    });
               /** toggle Event */
    $('.checkboxchecked').click(function(){                  
                    if($(this).is(":checked")){                        
                        $("#extrainfo"+$(this).attr('id')).show();
                    }
                    else if($(this).is(":not(:checked)")){
                      $("#extrainfo"+$(this).attr('id')).hide();                        
                    }
    });
    var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                    reader.onload = function (e) {
                    $('.profile-pic').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                    }
                }
    $(".file-upload").on('change', function(){
                    readURL(this);
                    var tempid = $("#temp_id").val();    
                    let formData = new FormData();
                    let file = $(this)[0].files[0];                    
                    formData.append('file', file, file.name);
                    formData.append('tempid',tempid);     
                    formData.append('type','profile_file'); 
                    $.ajax({
                            url: 'storefiledetail',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            type: 'POST',   
                            contentType: false,
                            processData: false,   
                            cache: false,        
                            data: formData,
                            success: function(res) {
                                if(res.Success == 'Success'){
                                                $.message({
                                                        type: "success",
                                                        text: "Successfully updated",
                                                        duration: 5000,
                                                        positon: "top-center",
                                                        showClose: true
                                                });
                                            }
                            },
                            error: function(data) {
                                console.log(data);
                            }
                        });          
    });
    $(".upload-button").on('click', function() {
               $(".file-upload").click();
    });
    function GetDynamicTextBox(value) {
                     return `<tr><td><input type="text" class="form-control names"  placeholder="Name"></td>
                                    <td><input type="text" class="form-control relationship"  placeholder="Relationship"></td>
                                    <td><input type="text" class="form-control age"   placeholder="Age"></td>
                                    <td><input type="text" class="form-control education" placeholder="Education"></td>
                                    <td><input type="text" class="form-control occuption"   placeholder="Occuption"></td>
                                    <td><span><i class="fa fa-plus plusevent" aria-hidden="true"></i></span><span><i class="fa fa-trash removeevent" aria-hidden="true"></i></span></td>
                            </tr>`;
    }
    $("body").on("click",".plusevent",function () {
                    console.log('hi');
                    var div = GetDynamicTextBox();
                    $("#TextBoxContainer").append(div);
    });
    $("body").on("click", ".removeevent", function () {
                    $(this).closest("tr").remove();
    });                
    function educationtextbox(value) {
                     return `<tr> 
                     <td><input type="text" class="form-control course"  placeholder="BE"></td>
                                                  <td><input type="text" class="form-control subject"  placeholder="Major Subject"></td>
                                                  <td><input type="text" class="form-control institute"  placeholder="Institute/Board/University"></td>                                                  
                                                  <td><input type="text" class="form-control duration" data-inputmask="'mask': '9999 to 9999'"  placeholder="Duration"></td>                                                  
                                                  <td><input type="text" class="form-control passing"  placeholder="Year of Passing"></td>
                                                  <td><input type="text" class="form-control cgpa"  placeholder="Percentage/CGPA"></td>                                                  
                                          <td><span><i class="fa fa-plus eduplusevent" aria-hidden="true"></i></span><span><i class="fa fa-trash eduremoveevent" aria-hidden="true"></i></span></td>
                                  </tr>`;
    }
    $("body").on("click",".eduplusevent",function () {    
                    var div = educationtextbox();                  
                    $("#education_details").append(div);
                    $(".duration").inputmask();
    });
    $("body").on("click", ".eduremoveevent", function () {
                    $(this).closest("tr").remove();
    }); 
    function trainingtextbox(value) {
                     return `<tr>                                
                                          
                                          <td><select class="form-control training"><option value="">Select Option</option><option value="App">Apprentice/In-Plant</option><option value="PP">Professional</option></select></td>
                                          <td><input type="text" class="form-control programme"  placeholder="Programme"></td>
                                          <td><input type="text" class="form-control institute"  placeholder="Institute"></td>                                          
                                          <td><input type="text" class="form-control duration"  data-inputmask="'mask': '9999 to 9999'"  placeholder="Duration"></td>                                          
                                          <td><span><i class="fa fa-plus trainingplusevent" aria-hidden="true"></i></span><span><i class="fa fa-trash trainingremoveevent" aria-hidden="true"></i></span></td>
                                  </tr>`;
    }
    $("body").on("click",".trainingplusevent",function (e) {
                    console.log('hi');
                    var div = trainingtextbox();                    
                    $("#training_details").append(div);
                    $(".duration").inputmask();
                    
    });
    $("body").on("click", ".trainingremoveevent", function () {
        $(this).closest("tr").remove();
    }); 
    function employmenttextbox(value)
    {
        return `<tr>                
                                
                                <td><input type="text" class="form-control organziation"   placeholder="Organization"></td>
                                <td><input type="text" class="form-control designation"   placeholder="Designation"></td>
                                <td><input type="text" class="form-control workperiod" data-inputmask="'mask': '9999 to 9999'" placeholder="Period of Work"></td>                                                                                      
                                <td><input type="text" class="form-control duration"   placeholder="Total Duration"></td>
                                <td><input type="text" class="form-control description"   placeholder="Job Description"></td>
                                <td><input type="text" class="form-control grosssalary"   placeholder="Gross Salary"></td>
                                <td><span><i class="fa fa-plus empplusevent" aria-hidden="true"></i></span><span><i class="fa fa-trash empremoveevent" aria-hidden="true"></i></span></td>
                        </tr>`;
    }
    $("body").on("click",".empplusevent",function () {                    
        var div = employmenttextbox();
        $("#employment_details").append(div);
        $(":input").inputmask();
    });
    $("body").on("click", ".empremoveevent", function () {
        $(this).closest("tr").remove();
    }); 
    function computerknowledge(value)
    {
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
    $("body").on("click",".ckplusevent",function () {                    
        var div = computerknowledge();
        $("#computer_knowledge").append(div);                    
    });
    $("body").on("click", ".ckevent", function () {
        $(this).closest("tr").remove();
    }); 
    function fileuploads(value)
    {
        return `<tr>  
                   <td><input type="text" class="form-control" placeholder="10th Marksheet"></td>
                   <td><input name="file-upload-field" type="file" class="file-upload-field btn btn-success" value=""> <button Class="btn btn-primary" style="float:right">Save</button>                                   </td>
                   <td><span><i class="fa fa-plus fileplusevent" aria-hidden="true"></i></span><span><i class="fa fa-trash ckremoveevent" aria-hidden="true"></i></span></td>
                </tr>`;
    }
    $("body").on("click",".fileplusevent",function () {                    
                    var div = fileuploads();
                    $("#file_details").append(div);                    
    });
    $("body").on("click", ".ckremoveevent", function () {
        $(this).closest("tr").remove();
    }); 
        /**End File Uploads */
});