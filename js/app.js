var app = null;

(function(){
  app = angular.module('app',[
    'ui.router',
		'ngAnimate',
		'ngMaterial',
    'angularFileUpload'
  ])
  .config(config)
  .run(run);

  config.$inject = ['$urlRouterProvider','$locationProvider','$stateProvider'];
  function config ($urlRouterProvider,$locationProvider,$stateProvider){
			$stateProvider
			.state('home',{
				url:'/',
				templateUrl:'templates/login.html',
				controller:'loginCtrl',
				data: {authenticate : false}
			})
      .state('signup',{
        url:'/sign-up',
        templateUrl:'templates/signup.html',
        controller:'signUpCtrl',
        data: {authenticate : false}
      })
      .state('user.pform',{
        url:'/user/proctor-form',
        templateUrl:'templates/proctor-form.html',
        controller:'pformCtrl',
        data: {authenticate : true}
      })
      .state('admin.home',{
        url:'/admin/home',
        templateUrl:'templates/admin/home.html',
        controller:'adminHomeCtrl',
        data: {authenticate : true}
      })
      .state('admin.adminBasicDetails',{
        url:'/admin/adminBasicDetails',
        templateUrl:'templates/admin/adminBasicDetails.html',
        controller:'adminBasicDetailsCtrl',
        data: {authenticate : true}
      }) 
      .state('admin.staffValidate',{
        url:'/admin/staffValidate',
        templateUrl:'templates/admin/staffValidate.html',
        controller:'staffValidateCtrl',
        data: {authenticate : true}
      })
      .state('user',{
        abstract: true,
        // url:'/user',
        templateUrl:'templates/user/base.html',
        data: {authenticate : true}
      })
       .state('admin',{
        abstract: true,
        // url:'/user',
        templateUrl:'templates/admin/base.html',
        data: {authenticate : true}
      })
      .state('user.home',{
        url:'/user/home',
        templateUrl:'templates/user/home.html',
        controller:'userHomeCtrl',
        data: {authenticate : true}
      });
    		$urlRouterProvider.otherwise('/');
    		$urlRouterProvider.when('/user','/user/home');
    		$locationProvider.html5Mode({
    		  enabled:false,
    		  requireBase: false
    		});

		};
    function run($rootScope,$state,Authenticate) {
      $rootScope.$on("$stateChangeStart", function(event,toState,toParams,fromState,fromParams){
        var connected = Authenticate.isLogged();

        if(toState.data.authenticate)
        {
            connected.then( function(msg){
                // console.log(msg.data);
                if (msg.data == "") {
                  $state.transitionTo('home');
                  event.preventDefault();
                }
            });


        }
    });
		};



})();
