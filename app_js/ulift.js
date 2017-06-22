/**
 * Created by bjwsl-001 on 2017/5/16.
 */
angular.module('uliftAPP',['ionic'])
    .config(function($stateProvider,$urlRouterProvider){
        $stateProvider
            .state('start',{
                url:'/start',
                templateUrl:'tpl/start.html',
                controller:'startCtr'
            })
            .state('advertise',{
                url:'/advertise',
                templateUrl:'tpl/advertise.html',
                controller:'advertiseCtr'
            })
            .state('main',{
                url:'/main',
                templateUrl:'tpl/main.html',
                controller:'mainCtr'
            })
            .state('list',{
                url:'/list',
                templateUrl:'tpl/list.html',
                controller:'listCtr'
            })
        $urlRouterProvider.otherwise('start');
    })
    .controller('parentCtr',['$scope','$state','$ionicModal',
        function($scope,$state,$ionicModal){
            $scope.jump = function(arg){
                $state.go(arg);
            };

            //创建摸态框对象
            $ionicModal.fromTemplateUrl('city.html', {
                scope: $scope,
                animation: 'slide-in-up'
            }).then(function(a) {
                $scope.cityM = a;
            });
            //定义打开和关闭的方法
            $scope.showCityModal = function(){
                $scope.cityM.show();
            };
            $scope.closeCityModal = function(){
                $scope.cityM.hide()()
            }

        }]
    )
    .controller('startCtr',function(){})
    .controller('advertiseCtr',['$scope','$interval',
        function($scope,$interval){
            //用变量存储用于轮播的图片数据
            $scope.imageArray = ['images/01.jpg',
            'images/02.jpg','images/03.jpg'];

            //使用定时器，修改num
            $scope.num = 10;
            $interval(function(){
                if($scope.num > 0)
                    $scope.num--;
                else {
                    //停止定时器并且跳转
                    $scope.$parent.jump('main');
                }
            },1000)
        }]
    )
    .controller('mainCtr',['$scope','$ionicScrollDelegate','$http','$timeout',
    function($scope,$ionicScrollDelegate,$http,$timeout){
        $scope.funcIndex = 2;
        $scope.showFuncs = function(n){
            $scope.funcIndex = n;
        }

        $scope.showHeader = false;
        $scope.getPosition = function(){
            var p = $ionicScrollDelegate.getScrollPosition().top;
            if(p>100)
                $scope.showHeader = true;
            else
                $scope.showHeader = false;

            $scope.$apply();  //强制刷新页面的绑定
        }

        //显示新闻数据
        $scope.newsPager = 1;
        $http.get('php/selectNews.php?pagenum=' + $scope.newsPager).success(
            function(r){
                $scope.newsData = r.data;
            }
        );

        //上拉加载更多
        $scope.isHasMore = true;
        $scope.loadMoreNews = function(){
            $timeout(function(){
                $scope.newsPager++;
                $http.get('php/selectNews.php?pagenum=' + $scope.newsPager).success(
                    function(r){
                        if(r.data.length < 3)
                            $scope.isHasMore = false;
                        $scope.newsData = $scope.newsData.concat(r.data);
                        $scope.$broadcast('scroll.infiniteScrollComplete');
                    }
                );
            },500);
        }
    }])
    .controller('listCtr',['$scope',function($scope){
        $scope.showList = true;
        $scope.listArray = [1,2,3,4,5,6,7,8];

        //将一维数组改写为二维，便于grid绑定
        $scope.gridArray = [];
        for(var i=0;i<$scope.listArray.length/2;i++){
            $scope.gridArray[i] = [];
            for(var j=0;j<2;j++){
                $scope.gridArray[i][j] =
                                $scope.listArray[i*2+j];
            }
        }

        $scope.toggleShow = function(){
            $scope.showList = !$scope.showList;
        };
    }])
