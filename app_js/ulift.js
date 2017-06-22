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

            //������̬�����
            $ionicModal.fromTemplateUrl('city.html', {
                scope: $scope,
                animation: 'slide-in-up'
            }).then(function(a) {
                $scope.cityM = a;
            });
            //����򿪺͹رյķ���
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
            //�ñ����洢�����ֲ���ͼƬ����
            $scope.imageArray = ['images/01.jpg',
            'images/02.jpg','images/03.jpg'];

            //ʹ�ö�ʱ�����޸�num
            $scope.num = 10;
            $interval(function(){
                if($scope.num > 0)
                    $scope.num--;
                else {
                    //ֹͣ��ʱ��������ת
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

            $scope.$apply();  //ǿ��ˢ��ҳ��İ�
        }

        //��ʾ��������
        $scope.newsPager = 1;
        $http.get('php/selectNews.php?pagenum=' + $scope.newsPager).success(
            function(r){
                $scope.newsData = r.data;
            }
        );

        //�������ظ���
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

        //��һά�����дΪ��ά������grid��
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
