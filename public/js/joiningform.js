function check(data) {
        if(data.name == ''){
          $("#errorname").show();
          return false;
        }else if(data.department == ''){
          $("#errordepartment").show();
          return false;          
        }else if(data.designation == ''){          
          $("#errordesignation").show();
          return false;
        }else if(data.date_interview == ''){          
          $("#errorinterview").show();
          return false;
        }else if(data.date_joining == ''){         
          $("#errorjoining").show();
          return false;
        }else if(data.email == ''){          
          $("#erroremail").show();
          return false;
        }else{         
          filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          if (filter.test(data.email)) {
              document.getElementById("emailid").style.border = "";
              $("#erroremail").hide();
              return true;
          } else {
              document.getElementById("emailid").style.border = "3px solid red";
              $("#erroremail").show();
              return false;
          }
        }      
    }
    function checkexisting(data){
      if(data.name == ''){
        $("#errornames").show();
        return false;
      }else if(data.employee_id == ''){
        $("#errorempids").show();
        return false;          
      }else if(data.designation == ''){          
        $("#errordesignations").show();
        return false;
      }else if(data.email == ''){          
        $("#erroremails").show();
        return false;
      }else{         
        filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (filter.test(data.email)) {
            document.getElementById("emailide").style.border = "";
            $("#erroremails").hide();
            return true;
        } else {
            document.getElementById("emailide").style.border = "3px solid red";
            $("#erroremails").show();
            return false;
        }
      }      
    }

   $(document).ready(function(){  

    $('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' });
      $('#interviewdate #interviewjoining').on('change', function(ev){
      $(this).datepicker('hide');
    });
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('body').on('click','.mailcopylink',function(){      
      var tempid  = $(this).attr('id');
      console.log(tempid);
      $.ajax({
        type:'GET',
        url:"joiningform/getmaillink/"+tempid,
        dataType:'json',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},                           
        success:function(res){   
          var maillink = '<div class="card"><div class="card-body">http://localhost/NASH_HRMS/public/enrollform/'+res.id+'</div></div>';
          $("#maillink").find('.modal-body').html(maillink);
          $("#maillink").modal('show');              
        }
      });      
    });
    $('body').on('click','.activateemployee',function(){
      var tempid  = $(this).attr('id');
      $("#empcodeId").val(tempid);
      $("#activatelink").modal('show');
    });

    $('body').on('click','.saveactivateemployee',function(){
      //swal("Hello world!");
      var tempid = $("#empcodeId").val();
      var employeecode = $("#Employeecode").val();
      if(employeecode != ''){
            swal({
              title: "Are you sure this is a employee code??",
              text: employeecode, 
              icon: "warning",
              buttons: true,
              dangerMode: true,
          }).then((willDelete) => {
             if (willDelete) {
              $.ajax({
                type:'POST',
                url:"joiningform/updateempcode",
                data:{primaryid:tempid,employee_id:employeecode},
                dataType:'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},                           
                success:function(res){   
                  if(res.Success = 'Success'){
                    swal("Employee Code update Successfully", {
                      icon: "success",
                    });
                    window.location.href = 'joiningform'; 
                  }                  
                }
              });        
             
            } else {
              swal("No Activate");
            }
            
           
          });
      }else {
        $("#Employeecode").focus();
      }
      
    });

    


    $('body').on('click','.checklistmodel',function(){
          $("#temp_empid").val($(this).attr('id'));
          var tempid  = $(this).attr('id');
          if(tempid != ''){
                $.ajax({
                            type:'GET',
                            url:"joiningform/getchecklist/"+tempid,
                            dataType:'json',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},                           
                            success:function(res){
                                if(res.length != 0){
                                  $(res[0]['employee_details']).each(function(key,value){
                                    if(value.val == 'Yes'){
                                      $( "#"+value.id ).prop( "checked", true);
                                      $("#"+value.id).closest('tr').find('.comments').val(value.comments);
                                    }else {
                                        $( "#"+value.id ).prop( "checked", false);
                                        $("#"+value.id).closest('tr').find('.comments').val(value.comments);
                                    }                                      
                                  });     
                                }else{
                                  $('#checklisttable').find(".checkboxchecked").each(function(){                   
                                      $(this).prop( "checked", false);
                                      $(this).closest('tr').find('.comments').val('');
                                  }); 
                                }
                            }
                });    
              }

          $("#checklistModal").modal('show');
    });
    $('body').on('click',"#checklistform_save", function(){
              var secondary_data = {};
              var tempid  = $("#temp_empid").val();
              secondary_data.temp_empid = $("#temp_empid").val();
              secondary_data.type_of = 'Checklist';
              secondary_data.employee_details =[];
              var checkpersonal = false;
              $('#checklisttable').find(".checkboxchecked").each(function(){                   
                var temp = {};
                var idinfo = $(this).attr('id');                       
                    if($(this).is(":checked")){                          
                        temp.id = idinfo;
                        temp.val = 'Yes'
                        temp.comments = $(this).closest('tr').find('.comments').val();
                    }
                    else if($(this).is(":not(:checked)")){
                        temp.id = idinfo;
                        temp.val = 'No'
                        temp.comments = $(this).closest('tr').find('.comments').val();
                    }
                    secondary_data.employee_details.push(temp);
                    checkpersonal =true;
              });   
              if(tempid != ''){
                $.ajax({
                            type:'POST',
                            url:'joiningform/personalDetail/storepersonaldetail',
                            dataType:'json',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data:{secondary:secondary_data,tempid:tempid,type_of:'Checklist'},
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
    $('body').on('click',".saveexistingemployee",function(e){
          e.preventDefault();   
          var ids= $(this).attr('id');   
          var data = {};
          data.name = $("#names").val();
          data.employee_id = $("#empid").val();
          data.designation = $("#designations").val();
          data.email = $("#emailide").val();               
          //checkexisting
          if(checkexisting(data)){          
            $.ajax({
              type:'POST',
              url:'./uploademployee',
              data:data,
              success:function(res){
                  if(res.Success == 'Success'){
                      if(ids =='redirect_joining'){
                        console.log(res.idvalue); 
                        // var urlstring = '{{ route("joiningform.joiningform.personal","id") }}';
                        //     urlstring = urlstring.replace('id',res.idvalue);
                            window.location.href = './personalDetail/'+res.idvalue;                        
                      }else{ 
                            $("#successmsg").show();
                            window.location.href = 'nashemployee';                                                   
                      }
                  }

              }
              });
          }        


    });      


    $('body').on('click',".saveemployee",function(e){
          e.preventDefault();   
          var ids= $(this).attr('id');   
          var data = {};
          data.name = $("#name").val();
          data.department = $("#department").val();
          data.designation = $("#designation").val();
          data.date_interview = $("#interviewdate").val();
          data.date_joining = $("#interviewjoining").val();
          data.email = $("#emailid").val();        
          if(check(data)){          
            $.ajax({
              type:'POST',
              url:'joiningform/uploademployee',
              data:data,
              success:function(res){
                  if(res.Success == 'Success'){
                      if(ids =='redirect_joining'){
                        console.log(res.idvalue); 
                        // var urlstring = '{{ route("joiningform.joiningform.personal","id") }}';
                        //     urlstring = urlstring.replace('id',res.idvalue);
                            window.location.href = 'joiningform/personalDetail/'+res.idvalue;                        
                      }else{ 
                            $("#successmsg").show();
                            window.location.href = 'joiningform';                                                   
                      }
                  }

              }
              });
          }        
    });

   });
