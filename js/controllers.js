(function(){
  angular.module('app')
    .controller('mainPageCtrl',['$scope',function($scope){
        $scope.message = "This is amaziing!!!";
    }])
    .controller('loginCtrl',['$scope','Authenticate','$http','$state','$mdToast',function($scope,Authenticate,$http,$state,$mdToast){

      $scope.incorrectPassword = function() {
	          	  $mdToast.show($mdToast.simple()
	          	  	.textContent('Incorrect Password!!')
	          	  	.position('top left')
	          	  	);
	          	};
      $scope.notVerified = function() {
	          	  $mdToast.show($mdToast.simple()
	          	  	.textContent('Please Verify Your account first only then you can login!!')
	          	  	.position('top left')
	          	  	);
	          	};

      $scope.logIn = function(data){
        var $data = angular.toJson(data);
        Authenticate.logIn($scope,$data).then(function(data){
           console.log(data.data);
           var user = data.data;
           if(user[0].account_type==0){
             $state.go('user.home',{});
           }
           else if(user[0].account_type==2){
             $state.go('admin.home',{});
           }
           else {
             $scope.incorrectPassword();
  					 $scope.msgtxt='Please enter the correct username and password';
  					 $state.go('home',{});
           }
        });
      }
    }])
    .controller('signUpCtrl',['$scope','user','$state','$mdDialog',function($scope,user,$state,$mdDialog){
      $scope.emailAvailable = 0;
      $scope.openFromLeft = function() {
      $mdDialog.show(
        $mdDialog.alert()
          .clickOutsideToClose(true)
          .title('Thank you for signing up!')
          .textContent('You may now Log In')
          .ariaLabel('Verification Dialog!')
          .ok('OK!!')
          // You can specify either sting with query selector
          // or an element
      );
     };
        $scope.validMail = function(){
          if($scope.noUser){
		   			return true;
		   		}
		   		else{
		   			return false;
		   		}
        }
        $scope.signUp = function(data){
          var $data = angular.toJson(data);
          user.signup($scope,$data).then(function(data){
            console.log(data.data);
            $scope.openFromLeft();
          });
          $state.go('home',{});
        }

    }])
    .controller('pformCtrl',['$scope','user',function($scope,user){
      user.fetchProctorBasic($scope);
      user.fetchProctorRest($scope);
      $scope.saveProctor = function(data){
        var $data = angular.toJson(data);
        user.saveProctor($scope,$data).then(function(data){

          $scope.form1.$setUntouched();
          $scope.user= " ";
          $scope.form1.$setPristine();

        });
      }
      $scope.shiftList = [
		        { time: 'I', value: 'I' },
		        { time: 'II', value: 'II' }
		      ];
      $scope.branchList = [
		        { name: 'Computer Engineering', value: 'Computer' },
		        { name: 'Mechanical Engineering', value: 'Mechanical' },
		        { name: 'Electronics and Telecommunication ', value: 'ENTC' }
		      ];
      $scope.yoaList = [
        {year:'2016-17', value: '16-17'},
        {year:'2017-18', value: '17-18'},
        {year:'2015-16', value: '15-16'},
        {year:'2014-15', value: '14-15'},
        {year:'2013-14', value: '13-14'},
        {year:'2012-13', value: '12-13'}
]

    }])


    .controller('userHomeCtrl',['$scope','user',function($scope,user){
        $scope.message = "heelo";
        user.fetchProctorBasic($scope);
        user.fetchProctorRest($scope);
        user.fetchCurrentClass($scope);
        user.fetchPrevAcademic($scope);
        user.fetchPhoto($scope);

    }])
    .controller('adminHomeCtrl',['$scope',function($scope){
        $scope.message = "ADMIN HOME PAGE";
    }])



    
    .controller('staffValidateCtrl',['$scope',function($scope){

        $scope.staffValidate = function(data){
        var $data = angular.toJson(data);
        staffData.staffValidate($scope,$data).then(function(data){


          $scope.staffValidateForm.$setUntouched();
          $scope.user= " ";
          $scope.staffValidateForm.$setPristine();

        });
      }

      $scope.branchList = [
            { name: 'Computer Engineering', value: 'Computer' },
            { name: 'Mechanical Engineering', value: 'Mechanical' },
            { name: 'Electronics and Telecommunication ', value: 'ENTC' },
            { name: 'IT Engineering ', value: 'IT' },
            { name: 'Civil Engineering ', value: 'Civil' }
          ];

      $scope.faculties = [
            { name: 'Dr. J. S. Umale', wanted: false },
            { name: 'Dr. Sonali Patil', wanted: false },
            { name: 'Prof. Sagar Salunkhe', wanted: false },
            { name: 'Prof. Sushma Vispute', wanted: false }
           ];
      

    }])

    .controller('validateCertificateCtrl',['$scope','$mdDialog',function($scope){

        $scope.validateCertificate = function(data){
        var $data = angular.toJson(data);
        staffData.validateCertificate($scope,$data).then(function(data){


          $scope.validateCertificateForm.$setUntouched();
          $scope.user= " ";
          $scope.validateCertificateForm.$setPristine();

        });
      }

       $scope.students = [
            { name: 'Sneha Kewlani', value: '1' },
            { name: 'Kshitij Malhara', value: '2'},
            { name: 'Priyanka Kakade', value:'3' },
            { name: 'Rohit Keswani', value: '4' }
           ];

      $scope.certificates = [
            { name: 'Java Certificate', wanted: false },
            { name: 'German Certificate', wanted: false },
            { name: 'Aptitude Certificate', wanted: false },
            { name: 'Personality Development Certificate', wanted: false }
           ];

       $scope.showAdvanced = function(ev) {
            $mdDialog.show({
                controller: DialogController,
                templateUrl: 'viewImage.tmpl.html',
                parent: angular.element(document.body),
                targetEvent: ev,
                clickOutsideToClose:true,
                fullscreen: $scope.customFullscreen // Only for -xs, -sm breakpoints.
            })
            .then(function(answer) {
               $scope.status = 'You said the information was "' + answer + '".';
            }, function() {
                $scope.status = 'You cancelled the dialog.';
            });
      };
      
       function DialogController($scope, $mdDialog) {
    $scope.hide = function() {
      $mdDialog.hide();
    };

    $scope.cancel = function() {
      $mdDialog.cancel();
    };

    $scope.answer = function(answer) {
      $mdDialog.hide(answer);
    };
  }


    }])

    .controller('selfDevelopmentMarksCtrl',['$scope',function($scope){

        $scope.staffValidate = function(data){
        var $data = angular.toJson(data);
        staffData.staffValidate($scope,$data).then(function(data){


          $scope.staffValidateForm.$setUntouched();
          $scope.user= " ";
          $scope.staffValidateForm.$setPristine();

        });
      }

     $scope.students = [
            { name: 'Sneha Kewlani', value: '1' },
            { name: 'Kshitij Malhara', value: '2'},
            { name: 'Priyanka Kakade', value:'3' },
            { name: 'Rohit Keswani', value: '4' }
           ];

      $scope.categories = [
            { name: 'Communication Skill Development' },
            { name: 'Aptitude Training' },
            { name: 'Technical Skill Development'},
            { name: 'Preparation for Higher Study' },
            { name: 'Entrepreneurship Development Program'},
            { name: 'Language Training'},
            { name: 'Finishing School'},
            { name: 'Spiritual and Holistic Development Program'}
           ]; 

       $scope.grades = [
        { name: 'A / 10 marks', value:'10' },
        { name: 'B / 5 marks' , value:'7' },
        { name: 'C / 3 marks' , value:'3' }
       ];


      

    }])

.controller('assignPtgCtrl',['$scope',function($scope){

        $scope.assignPtg = function(data){
        var $data = angular.toJson(data);
        staffData.assignPtg($scope,$data).then(function(data){


          $scope.assignPtgForm.$setUntouched();
          $scope.user= " ";
          $scope.assignPtgForm.$setPristine();

        });
      }

      $scope.branchList = [
            { name: 'Computer Engineering', value: 'Computer' },
            { name: 'Mechanical Engineering', value: 'Mechanical' },
            { name: 'Electronics and Telecommunication ', value: 'ENTC' },
            { name: 'IT Engineering ', value: 'IT' },
            { name: 'Civil Engineering ', value: 'Civil' }
          ];

       $scope.classes = [
            { name: 'F.E.', value: '1' },
            { name: 'S.E.', value: '2' },
              { name: 'T.E.', value: '3' },
                { name: 'B.E.', value: '4' }
          ];
      $scope.semester = [
            { name: 'I', value: '1' },
            { name: 'II', value: '2' }

          ];

      $scope.divisions = [
            { name: 'A / NO DIVISION', value: 'A' },
            { name: 'B', value: 'B' },
            { name: 'C', value: 'C' },
            { name: 'D', value: 'D' },
            { name: 'E', value: 'E' },
            { name: 'F', value: 'F' },
            { name: 'G', value: 'G' },
            { name: 'H', value: 'H' },
            { name: 'I', value: 'I' },
            { name: 'J', value: 'J' },
            { name: 'K', value: 'K' }
          ];
      $scope.students = [
            { name: 'Sneha Kewlani', wanted: false },
            { name: 'Kshitij Malhara', wanted: false },
            { name: 'Priyanka Kakade', wanted: false },
            { name: 'Rohit Keswani', wanted: false }
           ];

    }])


    .controller('adminBasicDetailsCtrl',['$scope',function($scope){
        $scope.adminBasicDetail = function(data){
        var $data = angular.toJson(data);
        user.adminBasicDetail($scope,$data).then(function(data){

          $scope.adminBasicDetailsForm.$setUntouched();
          $scope.user= " ";
          $scope.adminBasicDetailsForm.$setPristine();

        });
      }
      $scope.branchList = [
            { name: 'Computer Engineering', value: 'Computer' },
            { name: 'Mechanical Engineering', value: 'Mechanical' },
            { name: 'Electronics and Telecommunication ', value: 'ENTC' },
            { name: 'IT Engineering ', value: 'IT' },
            { name: 'Civil Engineering ', value: 'Civil' }
          ];
       $scope.designationList = [
            { name: 'Principal', value: '1' },
            { name: 'Dean', value: '2' },
            { name: 'Head of Department ', value: '3' },
            { name: 'Professor ', value: '4' },
            { name: 'Associate Professor ', value: '5' },
            { name: 'Assisstant Professor ', value: '6' },
            { name: 'Lab Assisstant ', value: '7' }
          ]
    }])


    .controller('profileMenuCtrl',['$scope','Authenticate','$state',function($scope,Authenticate,$state){
        $scope.logout = function(){
          Authenticate.logout();
          $state.go('home',{});
        }
    }])
    .controller('unitTestDataCtrl',['$scope','unitTestData',function($scope,unitTestData){

      $scope.classes = [
		        { name: 'F.E.', value: '1' },
		        { name: 'S.E.', value: '2' },
              { name: 'T.E.', value: '3' },
                { name: 'B.E.', value: '4' }
		      ];
      $scope.semester = [
		        { name: 'I', value: '1' },
		        { name: 'II', value: '2' }

		      ];
      $scope.unitTests = [
        { name: 'I', value: '1' },
        { name: 'II', value: '2' }
          ];

          $scope.checkUserEntry= function(userData){
            var $Udata = angular.toJson(userData);
            unitTestData.checkEntryUnitTest($scope,$Udata).then(function(userData){
              if(userData.data==0){
                  $scope.serverRespFalse = false;
                  $scope.serverRespTrue = true;
                }
              else {
                  $scope.serverRespFalse = true;
                  $scope.serverRespTrue = false;
              }

            });
          }
          $scope.saveUnitTestData= function(userData){
            var $Udata = angular.toJson(userData);
            unitTestData.storeUnitTestData($scope,$Udata).then(function(userData){

              $scope.serverRespFalse = false;
              $scope.serverRespTrue = false;
              console.log(userData.data);

            });
          }
    }])
    .controller('attendanceCtrl',['$scope','attendanceData',function($scope,attendanceData){
      $scope.classes = [
        { name: 'First Year', value: '1' },
        { name: 'Second Year', value: '2' },
        { name: 'Third Year', value: '3' },
        { name: 'Fourth Year', value: '4' }
      ];
        $scope.semester = [
        { name: 'I', value: '1' },
        { name: 'II', value: '2' }
      ];
      $scope.results = [
        {name:'Fortnight 1',value:'1'},
        {name:'Fortnight 2',value:'2'},
        {name:'Fortnight 3',value:'3'},
        {name:'Fortnight 4',value:'4'},
        {name:'Fortnight 5',value:'5'},
        {name:'Fortnight 6',value:'6'},
        {name:'Fortnight 7',value:'7'}
      ];
      $scope.checkUserEntry=function(userData){
        var $data=angular.toJson(userData);

        attendanceData.checkEntryAttendance($scope,$data).then(function(userData){
          console.log(userData);
          $scope.attendanceData = NaN;
          $scope.attendanceForm.$setUntouched();
          $scope.attendanceForm.$setPristine();

          if(userData.data == 0){
              $scope.positiveServerResp = true;
              $scope.negativeServerResp = false;
              $scope.thankYou = false;
            }
          else {
              $scope.positiveServerResp = false;
              $scope.negativeServerResp = true;
              $scope.thankYou = false;
              }
          });
        }

      $scope.saveAttendanceData = function(userData){
           var $data = angular.toJson(userData);

           attendanceData.storeAttendanceData($scope,$data).then(function(userData){

             $scope.positiveServerResp = false;
             $scope.negativeServerResp = false;
             $scope.thankYou = true;

          });
        }

    }])
    .controller('academicInfoCtrl',['$scope','academicData',function($scope,academicData){

      academicData.checkAcademicData().then(function(data){

          if(data.data == 0){
            $scope.negativeServResp = false ;
            $scope.positiveServResp = true;
            $scope.thankYou = false;

          }
          else {
            $scope.negativeServResp = true;
            $scope.positiveServResp = false;
            $scope.thankYou = false;

          }
      });

      $scope.submitAcademicInfo = function(data){
        var $data = angular.toJson(data);
        academicData.submitAcademicInfo($scope,$data).then(function(data){

          $scope.negativeServResp = false;
          $scope.positiveServResp = false;
          $scope.thankYou = true;

          $scope.academicDataForm.$setUntouched();
          $scope.academicData= " ";
          $scope.academicDataForm.$setPristine();

        });
      }
    }])
    .controller('studentMeetDataCtrl',function($scope,studentMeeting){
    $scope.serverResp = 0;
    $scope.classes = [
      { name: 'First Year', value: '1' },
      { name: 'Second Year', value: '2' },
      { name: 'Third Year', value: '3' },
      { name: 'Fourth Year', value: '4' }
    ];
      $scope.semester = [
      { name: 'I', value: '1' },
      { name: 'II', value: '2' }
    ];
          $scope.studMeetEntry = function(data){
            var $data = angular.toJson(data);
            studentMeeting.storeSession($data).then(function(){
                $scope.serverResp = 1;
                // console.log("hasd");
            });
          }
          $scope.saveData = function(data){
            var $data = angular.toJson(data);
            studentMeeting.saveData(data).then(function(data){
              console.log(data);
              $scope.serverResp = 0;
              $scope.studMeetForm.$setUntouched();
              $scope.choices= " ";
              $scope.studMeetForm.$setPristine();
            });
          }
          $scope.choices = [{}];
          $scope.addNewChoice = function() {
            $scope.choices.push({});
          };

          $scope.removeChoice = function(item) {
            $scope.choices.splice(item, 1);
            };

     })
     .controller('univExamCtrl',['$scope','univExamData',function($scope,univExamData){
       $scope.results = [
         {name:'Passed',value:'1'},
         {name:'Failed',value:'2'}
       ]
       $scope.choices = [{}];
       $scope.saveForm = function(data){
         var $data = angular.toJson(data);
         univExamData.submitData($data).then(function(data){
           console.log(data.data);
         })

       }
       $scope.addNewChoice = function() {
         $scope.choices.push({});
       };

       $scope.removeChoice = function(item) {
         $scope.choices.splice(item, 1);
         };
     }])
     .controller('ExtraEffortsInfoCtrl', function($scope,user) {
       $scope.choices = [{}];
  $scope.classes = [
    { name: 'First Year', value: '1' },
    { name: 'Second Year', value: '2' },
    { name: 'Third Year', value: '3' },
    { name: 'Fourth Year', value: '4' }
  ];
    $scope.semester = [
    { name: 'I', value: '1' },
    { name: 'II', value: '2' }
  ];

      $scope.activities = [
        {name:'Co-curricular',value:'1'},
        {name:'Extra-curricular',value:'2'},
        {name:'Add-on',value:'3'},
        {name:'Certifications',value:'4'},
        {name:'Training',value:'5'},
        {name:'Entrance Examinations',value:'6'},
        {name:'Placements',value:'7'},
        {name:'Others',value:'8'}
      ];

      $scope.Cocurriculars = [
        {name:'Workshop',value:'1'},
        {name:'Seminar',value:'2'},
        {name:'Project',value:'3'},
        {name:'Paper Presentation',value:'4'},
        {name:'Other',value:'8'}
      ];

      $scope.Extracurriculars = [
        {name:'Sports',value:'1'},
        {name:'Gathering',value:'2'},
        {name:'Art Circle',value:'3'},
        {name:'Technical Events',value:'4'},
        {name:'Other',value:'8'}
      ];


      $scope.Addons = [
        {name:'Technical',value:'1'},
        {name:'Foreign Language',value:'2'},
        {name:'Softskills',value:'3'},
        {name:'Aptitiude',value:'4'},
        {name:'Stress Management Courses',value:'5'},
        {name:'Other',value:'8'}
      ];

      $scope.Trainings = [
        {name:'Industrial',value:'1'},
        {name:'Sabbatical',value:'2'},
        {name:'Project Work',value:'3'},
        {name:'Workshops',value:'4'},
        {name:'Others',value:'8'}
      ];

      $scope.EntranceExams = [
        {name:'GATE',value:'1'},
        {name:'GRE',value:'2'},
        {name:'CAT',value:'3'},
        {name:'TOEFL',value:'4'},
        {name:'GMAT',value:'5'},
        {name:'Others',value:'8'}
      ]

      $scope.saveForm = function(data){
        var $data = angular.toJson(data);
        user.saveExtraEfforts($data).then(function(data){
          console.log(data.data);
        });
      }

      $scope.addNewChoice = function() {
        $scope.choices.push({});
      };

      $scope.removeChoice = function(item) {
        var removeCHoice = $scope.choices.length-1;
        $scope.choices.splice(removeCHoice);
        };

    })
    .controller('currentClassCtrl',['$scope','user',function($scope,user){
      $scope.classes = [
            { name: 'F.E.', value: '1' },
            { name: 'S.E.', value: '2' },
              { name: 'T.E.', value: '3' },
                { name: 'B.E.', value: '4' }
          ];
      $scope.semester = [
            { name: 'I', value: '1' },
            { name: 'II', value: '2' }

          ];
      $scope.divisions = [
            { name: 'A / NO DIVISION', value: 'A' },
            { name: 'B', value: 'B' },
            { name: 'C', value: 'C' },
            { name: 'D', value: 'D' },
            { name: 'E', value: 'E' },
            { name: 'F', value: 'F' },
            { name: 'G', value: 'G' },
            { name: 'H', value: 'H' }

          ];

        $scope.saveClass = function(data){
          var $data = angular.toJson(data);
          user.saveCurrentClass($data);
        }
    }])
    .controller('SelfDevCtrl',['$scope','SelfDevData',function($scope,SelfDevData){

      $scope.SelfDevEntry = function() {

      };
    }])
    .controller('certificateCtrl',['$scope','FileUploader','user',function($scope,FileUploader,user){
      $scope.imageShow = 0;

      user.fetchCertificates().then(function(data){
        $scope.certificates = data.data;
      });

      $scope.storeFile = function(data){
          var $data = angular.toJson(data);
          user.storeFileName($data);
          $scope.imageShow = 1;
      }

      var uploader = $scope.uploader = new FileUploader({
              url: '/ksm/data/upload/uploadCertificate.php'
          });

          uploader.filters.push({
              name: 'imageFilter',
              fn: function(item /*{File|FileLikeObject}*/, options) {
                  var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                  return '|jpg|png|jpeg|bmp|pdf|'.indexOf(type) !== -1;
              }
          });

          uploader.onCompleteItem = function(fileItem, response, status, headers) {
            $scope.imageShow = 0;
            uploader = " ";
          };
    }])
    .controller('uploadPhotoCtrl',['$scope','FileUploader',function($scope,FileUploader){
      var uploader = $scope.uploader = new FileUploader({
              url: '/ksm/data/upload/upload.php'
          });

          uploader.filters.push({
              name: 'imageFilter',
              fn: function(item /*{File|FileLikeObject}*/, options) {
                  var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                  return '|jpg|png|jpeg|bmp|pdf|'.indexOf(type) !== -1;
              }
          });

          uploader.onCompleteItem = function(fileItem, response, status, headers) {
              console.log(response);
          };

              // uploader.onCompleteAll = function(response) {
              //     console.info('onCompleteAll',response);
              // };
    }])
//=======
    .controller('SelfDevCtrl',['$scope',function($scope){
//>>>>>>> 29079b7feef880bbd0a8dfa795af60ba3fec25b

    }])


    //#################################################### DIRECTIVES
    .directive('ngUnique', function(user) {
    return {
      restrict: 'A',
      require: 'ngModel',
      link: function(scope, elm, attr, model) {
        elm.on('keyup',function(evt) {
          var val = elm.val();
          user.isUniqueUser(scope,val);
          });
        }
      }
    }) //#################################################### SERVICES
    .factory('user',['$http',function($http){
      return {
        signup: function(scope,data){
				    return  $http.post('/ksm/data/users/signup.php',data);
			   },
         isUniqueUser:function(scope,dat){
				var data = {
					email:dat
				};
				  $http.post('/ksm/data/users/isUniqueUser.php',data).then(function(data){

				  	if(data.data == 0){
				  		scope.showerr = false;
				  		scope.user1 = false;
				  		scope.noUser = true;
				  		scope.emailAvailable = 1;
				  	}
				  	else if (data.data == 1){
				  		scope.showerr = false;
				  		scope.user1 = true;
				  		scope.noUser = false;
				  		scope.emailAvailable = 2;

				  	}
				  	else{
				  		scope.showerr = true;
				  		scope.noUser = false;
				  		scope.user1 = false;
				  		scope.message = data.data;
				  		scope.emailAvailable = 2;

				  	     }
				      });
			     },
         saveProctor : function (scope,data) {
           return $http.post('/ksm/data/users/proctor-form.php',data);
         },
         fetchProctorBasic : function(scope){
           $http.post('/ksm/data/users/fetchProctorBasic.php').then(function(data){

             scope.user = data.data[0];
             if(data.data[0].date == "0000-00-00"){
   						scope.user.myDate = "";
   					}
   					else{
   					scope.user.myDate = new Date(data.data[0].myDate);
            scope.user.phone = parseInt(data.data[0].phone);
   					// scope.user.myDate = data.data.date;
   					}

           });;
         },
         fetchProctorRest : function(scope){
           $http.post('/ksm/data/users/fetchProctorRest.php').then(function(data) {
              scope.user.fathername = data.data[0].father_name;
              scope.user.foccupation = data.data[0].father_occ;
              scope.user.fcontact = data.data[0].father_contact;

              scope.user.mothername = data.data[0].mother_name;
              scope.user.moccupation = data.data[0].mother_occ;
              scope.user.mcontact = data.data[0].mother_contact;

              scope.user.guardianname = data.data[0].l_guardian_name;
              scope.user.gcontact = data.data[0].l_guardian_contact;

              scope.user.docname = data.data[0].doc_name;
              scope.user.docContact = data.data[0].doc_contact;

              scope.user.medicalHistory = data.data[0].med_history;
              scope.user.Personality = data.data[0].personality_traits;

              scope.user.interests = data.data[0].interest_hobbies;
              scope.user.awards = data.data[0].awards;
              scope.user.roleModel = data.data[0].inspiration;
           })
         },
         saveCurrentClass: function(data){
           $http.post('/ksm/data/proctor/saveCurrentClass.php',data).then(function(data){
             console.log(data.data);
           })
         },
         fetchCurrentClass: function(scope){
           $http.post('/ksm/data/users/fetchCurrentClass.php').then(function(data){
             scope.user.class = data.data.class;
             scope.user.division = data.data.division;
           });
         },
         saveExtraEfforts:function(data){
           return $http.post('/ksm/data/proctor/saveExtraEfforts.php',data);
         },
         fetchCertificates: function(){
          return $http.post('/ksm/data/proctor/fetchCertificates.php');
         },
         fetchPhoto: function(scope){
           $http.post('/ksm/data/proctor/fetchPhoto.php').then(function(data){
             scope.user.photo = data.data[0].photo;
           });
         },
         storeFileName: function(data){
            $http.post('/ksm/data/upload/storeFileNameInSession.php',data).then(function(data){
              console.log(data.data);
            });
         },
         saveCertificate: function(data){
           $http.post('/ksm/data/upload/uploadCertificate.php',data).then(function(data){

           });
         },
         fetchPrevAcademic: function(scope){
           $http.post('/ksm/data/users/fetchPrevAcademic.php').then(function(data){
             scope.user.yop = data.data[0].yop;
             scope.user.institute = data.data[0].institute;
             scope.user.percentage = data.data[0].percentage;
             scope.user.subjects = data.data[0].subjects;
             scope.user.achievements = data.data[0].achievements;
             scope.user.problems = data.data[0].problems;

             scope.user.yop1 = data.data[1].yop;
             scope.user.institute1 = data.data[1].institute;
             scope.user.percentage1 = data.data[1].percentage;
             scope.user.subjects1 = data.data[1].subjects;
             scope.user.achievements1 = data.data[1].achievements;
             scope.user.problems1 = data.data[1].problems;
           })
         }

      }
    }])
    .factory('Authenticate',['$http',function($http){
      return {
        isLogged: function(){
          var $checkSession = $http.post('/ksm/data/session/checkSession.php');
          return $checkSession;
        },
        logIn: function(scope,data){
         return $http.post('/ksm/data/session/login.php',data);
        },
        logout: function(scope,data) {
          $http.get('/ksm/data/session/logout.php');
        }
      }
    }])
    .factory('studentMeeting',['$http',function($http){
      return {
        storeSession: function(data){
          return $http.post('/ksm/data/proctor/storeSession.php',data);
        },
        saveData: function(data){
          return $http.post('/ksm/data/proctor/saveMeetingData.php',data);
        }
      }
    }])
    .factory('academicData',['$http',function($http){
      return {
        submitAcademicInfo: function(scope,data){
          return $http.post('/ksm/data/proctor/submitAcademicInfo.php',data);
        },
        checkAcademicData: function(){
          return $http.post('/ksm/data/proctor/checkAcademicData.php');
        }
      }
    }])
    // .factory('SelfDevData',['$http',function($http){
    //   return {
    //     SelfDevEntry: function(scope,data){
    //
    //     }
    //
    //   }
    // }])
    .factory('unitTestData',['$http',function($http){
      return {
        checkEntryUnitTest: function($scope,data){
          return $http.post('/ksm/data/proctor/checkEntryUnitTest.php',data);
        },
        storeUnitTestData: function(scope,data){
          return $http.post('/ksm/data/proctor/storeUnitTestData.php',data);
        }

      }
    }])
    .factory('univExamData',['$http',function($http){
      return {
        submitData: function($data){
          return $http.post('/ksm/data/proctor/storeUnivData.php',$data);
        }
      }
    }])
    .factory('attendanceData',['$http',function($http){
      return {
        checkEntryAttendance: function($scope,data){
          return $http.post('/ksm/data/proctor/checkEntryAttendance.php',data);
        },
        storeAttendanceData: function(scope,data){
          return $http.post('/ksm/data/proctor/storeAttendanceData.php',data);
        }

      }
    }]);
})();
