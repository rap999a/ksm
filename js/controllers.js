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
           var user = data.data[0];
           console.log(user);
           if(user.account_type == 0){
             $state.go('user.home',{});
           }
           else if(user.account_type == 1 && user.approve == 1){
             $state.go('staff.home',{});
           }
           else if(user.account_type == 1 && user.approve == 0){
             $scope.notVerified();
           }
           else if(user.account_type == 2 && user.approve == 1){
             $state.go('admin.home',{});
           }
           else if(user.account_type == 2 && user.approve == 0){
             $scope.notVerified();
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
      $scope.IdAvailable = 0;
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

    .controller('userHomeCtrl',['$scope','user','adminFunctions',function($scope,user,adminFunctions){
        $scope.message = "heelo";
        user.fetchProctorBasic($scope);
        user.fetchProctorRest($scope);
        user.fetchCurrentClass($scope);
        user.fetchPrevAcademic($scope);
        user.fetchPhoto($scope);
        adminFunctions.fetchMyPTG().then(function(data){
          $scope.ptg = data.data[0];
        })

    }])
    .controller('staffHomeCtrl',['$scope','user',function($scope,user){
      user.fetchProctorBasic($scope);

    }])
    .controller('adminHomeCtrl',['$scope','user',function($scope,user){
      user.fetchProctorBasic($scope);
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
    .controller('studentMeetDataCtrl',function($scope,studentMeeting,adminFunctions,$mdDialog){
      adminFunctions.fetchMyStudents().then(function(data){
        $scope.students = data.data;
      });
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
                $scope.errorThrow = function() {
                  $mdDialog.show(
                    $mdDialog.alert()
                    .clickOutsideToClose(true)
                    .title('Oops Something went wrong!')
                    .textContent('This is dialog is because you tried to make a back dated entry or you making an entry after the alloted time viz (JAN - MARCH & JULY - SEP)')
                    .ariaLabel('Error Dialog!')
                    .ok('OK!!')
                    // You can specify either sting with query selector
                    // or an element
                  );
                };

          $scope.saveData = function(user,data){
            var toServer = [];
            toServer[0] = user;
            toServer[1] = data;
            var $data = angular.toJson(toServer);
            studentMeeting.saveData($data).then(function(data){

              if (data.data == 0) {
                $scope.errorThrow();
              }
              $scope.serverResp = 0;
              $scope.meetingForm.$setUntouched();
              $scope.choices= [{}];
              $scope.meetingForm.$setPristine();
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

    .controller('SelfDevCtrl',['$scope','SelfDevData',function($scope,SelfDevData){
      $scope.SelfDevComSkill = function(data){
        var data1 = [];
        data1[0] = data;
        data1.push({type:1});
        var $data = angular.toJson(data1);
        SelfDevData.saveData($data);
      }
      $scope.SelfDevAptiTraining = function(data){
        var data1 = [];
        data1[0] = data;
        data1.push({type:2});
        var $data = angular.toJson(data1);
        SelfDevData.saveData($data);
      }
      $scope.TechSkillDevData = function(data){
        var data1 = [];
        data1[0] = data;
        data1.push({type:3});
        var $data = angular.toJson(data1);
        SelfDevData.saveData($data);
      }
      $scope.prepData = function(data){
        var data1 = [];
        data1[0] = data;
        data1.push({type:4});
        var $data = angular.toJson(data1);
        SelfDevData.saveData($data);
      }
      $scope.EDprogData = function(data){
        var data1 = [];
        data1[0] = data;
        data1.push({type:5});
        var $data = angular.toJson(data1);
        SelfDevData.saveData($data);
      }
      $scope.langTrainData = function(data){
        var data1 = [];
        data1[0] = data;
        data1.push({type:6});
        var $data = angular.toJson(data1);
        SelfDevData.saveData($data);
      }
      $scope.finishingSchool = function(data){
        var data1 = [];
        data1[0] = data;
        data1.push({type:7});
        var $data = angular.toJson(data1);
        SelfDevData.saveData($data);
      }
      $scope.spiritualHolData = function(data){
        var data1 = [];
        data1[0] = data;
        data1.push({type:8});
        var $data = angular.toJson(data1);
        SelfDevData.saveData($data);
      }
      $scope.intData = function(data){
        var data1 = [];
        data1[0] = data;
        data1.push({type:9});
        var $data = angular.toJson(data1);
        SelfDevData.saveData($data);
      }

    }])
    .controller('staffDetailsCtrl',['$scope','user',function($scope,user){

      user.fetchProctorBasic($scope);
      $scope.saveBasicDetail = function(data){
        var $data = angular.toJson(data);
        user.saveProctor($scope,$data).then(function(data){
          console.log(data.data);
        });
      }

      $scope.branchList = [
            { name: 'Computer Engineering', value: 'Computer' },
            { name: 'Mechanical Engineering', value: 'Mechanical' },
            { name: 'Electronics and Telecommunication ', value: 'ENTC' }
          ];
      $scope.designationList = [
            { name: 'Professor', value: 'Professor' },
            { name: 'Associate Professor', value: 'Associate Professor' },
            { name: 'Assistant Professor', value: 'Assistant Professor' },
            { name: 'HOD', value: 'HOD' },
            { name: 'Dean', value: 'Dean' },
            { name: 'Principal', value: 'Principal' }
          ];

    }])
    .controller('adminDetailsCtrl',['$scope','user',function($scope,user){

      user.fetchProctorBasic($scope);
      $scope.saveBasicDetail = function(data){
        var $data = angular.toJson(data);
        user.saveProctor($scope,$data).then(function(data){
          console.log(data.data);
        });
      }

      $scope.branchList = [
            { name: 'Computer Engineering', value: 'Computer' },
            { name: 'Mechanical Engineering', value: 'Mechanical' },
            { name: 'Electronics and Telecommunication ', value: 'ENTC' }
          ];
      $scope.designationList = [
            { name: 'Professor', value: 'Professor' },
            { name: 'Associate Professor', value: 'Associate Professor' },
            { name: 'Assistant Professor', value: 'Assistant Professor' },
            { name: 'HOD', value: 'HOD' },
            { name: 'Dean', value: 'Dean' },
            { name: 'Principal', value: 'Principal' }
          ];

    }])
    .controller('researchDataCtrl',['$scope','researchData',function($scope,researchData){
        $scope.choices = [{}];

        $scope.classes = [
            { name: 'Patent', value: '1' },
            { name: 'IPR', value: '2' },
              { name: 'Revenue', value: '3' }
          ];
          $scope.saveFormResearchState = function(data,choice){
            var data1 = [];
            data1[0] = data;
            data1.push({type:3,subtype:3});
            data1.push(choice);
            var $data = angular.toJson(data1);
            researchData.submitData($data);
          }
          $scope.saveFormResearchInternational = function(data,choice){
            var data1 = [];
            data1[0] = data;
            data1.push({type:3,subtype:1});
            data1.push(choice);
            var $data = angular.toJson(data1);
            researchData.submitData($data);

          }
          $scope.saveFormResearchNational = function(data,choice){
            var data1 = [];
            data1[0] = data;
            data1.push({type:3,subtype:2});
            data1.push(choice);
            var $data = angular.toJson(data1);
            researchData.submitData($data);

          }
          $scope.saveFormResearchMajor = function(data,choice){
            var data1 = [];
            data1[0] = data;
            data1.push({type:1,subtype:1});
            data1.push(choice);
            var $data = angular.toJson(data1);
            researchData.submitData($data);

          }
          $scope.saveFormResearchMini = function(data,choice){
            var data1 = [];
            data1[0] = data;
            data1.push({type:1,subtype:2});
            data1.push(choice);
            var $data = angular.toJson(data1);
            researchData.submitData($data);

          }
          $scope.saveFormResearchTInt = function(data,choice){
            var data1 = [];
            data1[0] = data;
            data1.push({type:1,subtype:3});
            data1.push(choice);
            var $data = angular.toJson(data1);
            researchData.submitData($data);

          }
          $scope.saveFormResearchTCol = function(data,choice){
            var data1 = [];
            data1[0] = data;
            data1.push({type:1,subtype:4});
            data1.push(choice);
            var $data = angular.toJson(data1);
            researchData.submitData($data);

          }
          $scope.saveFormResearchIPR = function(data,choice){
            var data1 = [];
            data1[0] = data;
            data1.push({type:2,subtype:1});
            data1.push(choice);
            var $data = angular.toJson(data1);
            researchData.submitData($data);

          }


          $scope.addNewChoice = function() {
            $scope.choices.push({});
          };

       $scope.removeChoice = function(item) {
         var removeCHoice = $scope.choices.length-1;
         $scope.choices.splice(removeCHoice);
         };


    }])
    .controller('ptgDataCtrl',['$scope',function(){

    }])
    .controller('criticalAnalysisDataCtrl',function($scope,criticalAnalysis,adminFunctions){
    $scope.serverResp = 0;
    adminFunctions.fetchMyStudents().then(function(data){
      $scope.students = data.data;
    });
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
      $scope.types = [
      { name: 'Appreciation,Disciplinary Actions, Motivational/ Psychological/ Medical/ Personal issues', value: '0' },
      { name: 'Measures / Actions suggested by PTG and their review', value: '1' }
    ];
          $scope.criticalAnalysisEntry = function(student,remarks){
            var toServer = [];
            toServer[0] = student;
            toServer[1] = remarks;
            var $data = angular.toJson(toServer);
            adminFunctions.storeCriticalAnalysis($data).then(function(data){
              $scope.choices=[{}];
            });
          }
          $scope.saveData = function(data){
            var $data = angular.toJson(data);
              console.log(data);
            criticalAnalysis.saveData(data).then(function(data){
            //   $scope.serverResp = 0;
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
    .controller('ptgRecordDataCtrl',function($scope,ptgRecordData,adminFunctions){ //adaaaaaaaaaaaaa
    $scope.serverResp = 0;
    adminFunctions.fetchMyStudents().then(function(data){
      $scope.students = data.data;
    });
    $scope.classes = [
      { name: 'First Year', value: '1' },
      { name: 'Second Year', value: '2' },
      { name: 'Third Year', value: '3' },
      { name: 'Fourth Year', value: '4' }
    ];
    $scope.years = [
      { name: '2014-15', value: '1' },
      { name: '2015-16', value: '2' },
      { name: '2016-17', value: '3' },
      { name: '2017-18', value: '4' }
    ];
      $scope.semester = [
      { name: 'I', value: '1' },
      { name: 'II', value: '2' }
    ];
          $scope.ptgRecordEntry = function(data){
            var $data = angular.toJson(data);
            ptgRecordData.fetchPTG($data).then(function(data){
                $scope.serverResp = 1;
                $scope.staffs = data.data;

            });
          }

     })
     .controller('validateCertificateCtrl',function($scope,$mdDialog,adminFunctions){
       $scope.serverResp = 0;
       adminFunctions.fetchMyStudents().then(function(data){
         $scope.students = data.data;
       });

        $scope.selectStudent = function(data){
          var $data = angular.toJson(data);
          adminFunctions.fetchCertificates($data).then(function(data){
            $scope.certificates = data.data;
            $scope.serverResp = 1;
            console.log(data.data);
          })
        }
        $scope.validateCertificate = function(data){
        var $data = angular.toJson(data);
        adminFunctions.validateCertificate($data).then(function(data){
          console.log(data.data);
          $scope.validateCertificateForm.$setUntouched();
          $scope.certificates= " ";
          $scope.validateCertificateForm.$setPristine();
        //
        });
      }
       $scope.students = [
            { name: 'Sneha Kewlani', value: '1' },
            { name: 'Kshitij Malhara', value: '2'},
            { name: 'Priyanka Kakade', value:'3' },
            { name: 'Rohit Keswani', value: '4' }
           ];

           $scope.hello = "as";
       $scope.showAdvanced = function(path) {
            $mdDialog.show({
                controller: DialogController,
                templateUrl: 'templates/staff/viewImage.tmpl.html',
                parent: angular.element(document.body),
                locals: {
                  path: path
                },
                // targetEvent: ev,
                clickOutsideToClose:true,
                fullscreen: $scope.customFullscreen // Only for -xs, -sm breakpoints.
            })
            .then(function(answer) {
               $scope.status = 'You said the information was "' + answer + '".';
            }, function() {
                $scope.status = 'You cancelled the dialog.';
            });
      };

       function DialogController($scope, $mdDialog, path) {
         $scope.path = path;
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


})
    .controller('extraCurriDataCtrl',['$scope','extraCurriData',function($scope,extraCurriData){
      $scope.choices = [{}];

       $scope.saveExtraPANA = function(data,choice){
         var data1 = [];
         data1[0] = data;
         data1.push({type:2,subtype:1});
         data1.push(choice);
         var $data = angular.toJson(data1);
        //  console.log($data);
         extraCurriData.submitData($data);
       }
       $scope.saveExtraLDA = function(data,choice){
         var data1 = [];
         data1[0] = data;
         data1.push({type:5,subtype:1});
         data1.push(choice);
         var $data = angular.toJson(data1);
         extraCurriData.submitData($data);
       }
       $scope.saveExtraSSPA = function(data,choice){
         var data1 = [];
         data1[0] = data;
         data1.push({type:4,subtype:2});
         data1.push(choice);
         var $data = angular.toJson(data1);
         extraCurriData.submitData($data);
       }
       $scope.saveExtraSSSA = function(data,choice){
         var data1 = [];
         data1[0] = data;
         data1.push({type:4,subtype:1});
         data1.push(choice);
         var $data = angular.toJson(data1);
         extraCurriData.submitData($data);
       }
       $scope.saveExtraSPC = function(data,choice){
         var data1 = [];
         data1[0] = data;
         data1.push({type:3,subtype:3});
         data1.push(choice);
         var $data = angular.toJson(data1);
         extraCurriData.submitData($data);
       }
       $scope.saveExtraSPU = function(data,choice){
         var data1 = [];
         data1[0] = data;
         data1.push({type:3,subtype:2});
         data1.push(choice);
         var $data = angular.toJson(data1);
         extraCurriData.submitData($data);
       }
       $scope.saveExtraSPNA = function(data,choice){
         var data1 = [];
         data1[0] = data;
         data1.push({type:3,subtype:1});
         data1.push(choice);
         var $data = angular.toJson(data1);
         extraCurriData.submitData($data);
       }
       $scope.saveExtraVIC = function(data,choice){
         var data1 = [];
         data1[0] = data;
         data1.push({type:2,subtype:3});
         data1.push(choice);
         var $data = angular.toJson(data1);
         extraCurriData.submitData($data);
       }
       $scope.saveExtraVIU = function(data,choice){
         var data1 = [];
         data1[0] = data;
         data1.push({type:2,subtype:2});
         data1.push(choice);
         var $data = angular.toJson(data1);
         extraCurriData.submitData($data);
       }
       $scope.saveExtraVINA = function(data,choice){
         var data1 = [];
         data1[0] = data;
         data1.push({type:2,subtype:1});
         data1.push(choice);
         var $data = angular.toJson(data1);
         extraCurriData.submitData($data);
       }
       $scope.saveExtraPAC = function(data,choice){
         var data1 = [];
         data1[0] = data;
         data1.push({type:1,subtype:3});
         data1.push(choice);
         var $data = angular.toJson(data1);
         extraCurriData.submitData($data);
       }
       $scope.saveExtraPAU = function(data,choice){
         var data1 = [];
         data1[0] = data;
         data1.push({type:1,subtype:2});
         data1.push(choice);
         var $data = angular.toJson(data1);
         extraCurriData.submitData($data);
       }
       $scope.saveExtraPANA = function(data,choice){
         var data1 = [];
         data1[0] = data;
         data1.push({type:1,subtype:1});
         data1.push(choice);
         var $data = angular.toJson(data1);
         extraCurriData.submitData($data);
       }


       $scope.addNewChoice = function() {
         $scope.choices.push({});
       };

       $scope.removeChoice = function(item) {
         $scope.choices.splice(item, 1);
         };


    }])
    .controller('assessmentCtrl',['$scope','user',function($scope,user){
      user.fetchAssessment($scope);
    }])
    .controller('adminApproveAccountsCtrl',['$scope','adminFunctions',function($scope,adminFunctions){

      $scope.staffValidate = function(data){
        var $data = angular.toJson(data);
        adminFunctions.validateStaff($data).then(function(data){
          location.reload(true);
        });
      }

      adminFunctions.fetchUnvalidatedStaff().then(function(data){
        $scope.faculties = data.data;
      });



    }])
    .controller('assignPtgCtrl',['$scope','adminFunctions',function($scope,adminFunctions){
            $scope.showList = 0;
            $scope.showList1 = 0;
            var dataToServer = [];
            $scope.assignPtg = function(data,staff){
              dataToServer[0] = data;
              dataToServer[1] = staff;
              var $data = angular.toJson(dataToServer);
              adminFunctions.assignPtg($data).then(function(data){
                console.log(data.data);
              });

            }

            $scope.checkUser = function(data){
              var $data = angular.toJson(data);
              adminFunctions.fetchStaffStudent($data).then(function(data){
                $scope.students = data.data[1];
                $scope.staffList = data.data[0];
                $scope.showList = 1;

              })
            }

            $scope.fetchData = function(data){
              var $data = angular.toJson(data);
              adminFunctions.fetchPTGs($data).then(function(data){
                $scope.ptgs = data.data;
                $scope.showList1 = 1;

              });
            }
            $scope.deleteStudent = function(data,index){
              var $data = angular.toJson(data[index]);
              adminFunctions.deleteStudent($data).then(function(data){
                location.reload(true);
              });
            }
            $scope.fetchStudentOfPTG = function(data){
              var $data = angular.toJson(data);
              adminFunctions.fetchStudentOfPTG($data).then(function(data){
                $scope.students1 = data.data;
              //   $scope.staffList1 = data.data[0];
              //   $scope.showList1 = 1;

              })
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
            // $scope.students = [
            //       { name: 'Sneha Kewlani', wanted: false },
            //       { name: 'Kshitij Malhara', wanted: false },
            //       { name: 'Priyanka Kakade', wanted: false },
            //       { name: 'Rohit Keswani', wanted: false }
            //      ];

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
    })
    .directive('ngUniqueId', function(user) {
    return {
      restrict: 'A',
      require: 'ngModel',
      link: function(scope, elm, attr, model) {
        elm.on('keyup',function(evt) {
          var val = elm.val();
          user.isUniqueId(scope,val);
          });
        }
      }
    })
    //#################################################### SERVICES
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
         isUniqueId:function(scope,dat){
				var data = {
					student_id:dat
				};
				  $http.post('/ksm/data/users/isUniqueId.php',data).then(function(data){
				  	if(data.data == 0){
				  		scope.showerr = false;
				  		scope.user2 = false;
				  		scope.noUser = true;
				  		scope.IdAvailable = 1;
				  	}
				  	else if (data.data == 1){
				  		scope.showerr = false;
				  		scope.user2 = true;
				  		scope.noUser = false;
				  		scope.IdAvailable = 2;

				  	}
				  	else{
				  		scope.showerr = true;
				  		scope.noUser = false;
				  		scope.user2 = false;
				  		scope.message = data.data;
				  		scope.IdAvailable = 2;

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
         fetchAssessment: function(scope){
            $http.post('/ksm/data/calc/calcMarks.php').then(function(data){
                scope.marks = data.data;
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
          return $http.post('/ksm/data/staffFunctions/saveMeetingData.php',data);
        }
      }
    }])
    .factory('criticalAnalysis',['$http',function($http){
      return {
        storeSession: function(data){
          return $http.post('/ksm/data/proctor/storeSession.php',data);
        },
        saveData: function(data){
          return $http.post('/ksm/data/staffFunctions/savecriticalAnalysisData.php',data);
        }
      }
    }])
    .factory('adminFunctions',['$http',function($http){
      return {
        fetchUnvalidatedStaff: function(){
          return $http.get('/ksm/data/adminFunctions/fetchUnvalidatedStaff.php');
        },
        validateStaff: function(data){
          return $http.post('/ksm/data/adminFunctions/validateStaff.php',data);
        },
        fetchStaffStudent: function(data){
          return $http.post('/ksm/data/adminFunctions/fetchStaffStudent.php',data);
        },
        assignPtg: function(data){
          return $http.post('/ksm/data/adminFunctions/assignPtg.php',data);
        },
        fetchPTGs: function(data){
          return $http.post('/ksm/data/adminFunctions/fetchPTGs.php',data);
        },
        fetchStudentOfPTG: function(data){
          return $http.post('/ksm/data/adminFunctions/fetchStudentOfPTG.php',data);
        },
        deleteStudent: function(data){
          return $http.post('/ksm/data/adminFunctions/deleteStudent.php',data);
        },
        fetchMyPTG: function(){
          return $http.post('/ksm/data/adminFunctions/fetchMyPTG.php');
        },
        fetchMyStudents: function(){
          return $http.post('/ksm/data/adminFunctions/fetchMyStudents.php');
        },
        storeCriticalAnalysis: function(data){
          return $http.post('/ksm/data/staffFunctions/savecriticalAnalysisData.php',data);
        },
        fetchCertificates: function(data){
          return $http.post('/ksm/data/staffFunctions/fetchCertificates.php',data);
        },
        validateCertificate: function(data){
          return $http.post('/ksm/data/staffFunctions/validateCertificate.php',data);
        }
      }

    }])
    .factory('extraCurriData',['$http',function($http){
      return {
        submitData: function(data){
          $http.post('/ksm/data/proctor/storeextraCurriData.php',data).then(function(data){
            console.log(data.data);
          });
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
    .factory('SelfDevData',['$http',function($http){
      return {
        saveData: function(data){
          $http.post('/ksm/data/proctor/saveSelfDevData.php',data).then(function(data){
            console.log(data.data);
          });
        }

      }
    }])
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
    .factory('researchData',['$http',function($http){
     return {
      checkEntryResearch: function($scope,data){
         return $http.post('/ksm/data/proctor/checkResearch.php',data);
       },
       submitData: function(data){
         $http.post('/ksm/data/proctor/storeResearchData.php',data).then(function(data){
           console.log(data.data);
         });

       }
     }
   }])
   .factory('ptgRecordData',['$http',function($http){
      return {
        fetchPTG: function(data){
          return $http.post('/ksm/data/staffFunctions/fetchPTG.php',data);
        },
        saveData: function(data){
          return $http.post('/ksm/data/proctor/saveptgRecordData.php',data);
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
