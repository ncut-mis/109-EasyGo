

@extends('layouts.master')
@section('title','食譜名稱')
@section('content')
    <!-- Page Content-->
    <section class="py-5">
        <div class="container px-5 my-5 ">
            <div class="row gx-5">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div >
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
{{--                        <header class="mb-4">--}}
{{--                            <h1 class="fw-bolder mb-1 ">寫食譜</h1>--}}
{{--                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">--}}

{{--                                <button type="button" class="btn btn-danger btn-lg">發布</button>--}}
{{--                                <button type="button" class="btn  btn-lg">儲存</button>--}}
{{--                                <button type="button" class="btn btn-lg">刪除</button>--}}
{{--                            </div>--}}

{{--                                    <!-- Post title-->--}}
{{--                                    <div class="mb-3">--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <label for="exampleFormControlInput1" class="form-label">食譜名稱</label>--}}
{{--                                            <!--回傳時會把name包裝成key，填入的內容包裝成value-->--}}
{{--                                            <input name="name" id="name" type="text" class="form-control" placeholder="請輸入食譜名稱"><!--單行輸入框-->--}}
{{--                                        </div>--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <label for="exampleFormControlTextarea1" class="form-label">食譜封面</label>--}}
{{--                                            <input type="file" name="image" id="image" accept="image/*" class="form-control">--}}
{{--                                        </div>--}}
{{--                                        <label for="exampleFormControlTextarea1" class="form-label">食譜類別</label>--}}
{{--                                        <div class="ms-3 me-3">--}}
{{--                                            <div class="row">--}}

{{--                                                <div class="form-check col">--}}
{{--                                                    <input class="form-check-input" type="radio" name="category" id="category" value="1" checked>--}}
{{--                                                    <label class="form-check-label" for="flexRadioDefault1">中式</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check col">--}}
{{--                                                    <input class="form-check-input" type="radio" name="category" id="category" value="2">--}}
{{--                                                    <label class="form-check-label" for="flexRadioDefault2">西式</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check col">--}}
{{--                                                    <input class="form-check-input" type="radio" name="category" id="category" value="3">--}}
{{--                                                    <label class="form-check-label" for="flexRadioDefault2">日式--}}
{{--                                                    </label>--}}
{{--                                                </div>--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                            <div class="mb-3">--}}
{{--                                <label for="exampleFormControlTextarea1" class="form-label">食譜簡介</label>--}}
{{--                                <textarea name="introduce" id="introduce" class="form-control" rows="4" placeholder="請輸入食譜簡介"></textarea><!--多行輸入框-->--}}
{{--                            </div>--}}
                            <h1 class="fw-bolder mb-1 ">食材   <button type="button" class="btn  btn-lg">+</button></h1></h1>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">食材名稱</th>
                                    <th scope="col">食材另購買處</th>
                                    <th scope="col">數量</th>

                                </tr>
                                </thead>

                                <td>
                                    <input type="text" class="name" value="">
                                </td>
                                <td>
                                    <input type="text" class="name" value="">
                                </td>
                                <td>
                                    <input type="text" class="name" value="">
                                </td>



                            </table>


                            <h1 class="fw-bolder mb-1 ">步驟1 <button type="button" class="btn btn-lg">+</button></h1>

                            <div class="mb-3">
                                <input type="file" name="image" id="image" accept="image/*" class="form-control">
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label"></label>
                                    <textarea name="introduce" id="introduce" class="form-control" rows="4" placeholder=""></textarea><!--多行輸入框-->
                                </div>

                                <h1 class="fw-bolder mb-1 ">步驟2</h1>
                                <div class="mb-3">
                                    <input type="file" name="image" id="image" accept="image/*" class="form-control">
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label"></label>
                                        <textarea name="introduce" id="introduce" class="form-control" rows="4" placeholder=""></textarea><!--多行輸入框-->
                                    </div>

                                    <h1 class="fw-bolder mb-1 ">步驟3</h1>
                                    <div class="mb-3">
                                        <input type="file" name="image" id="image" accept="image/*" class="form-control">
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label"></label>
                                            <textarea name="introduce" id="introduce" class="form-control" rows="4" placeholder=""></textarea><!--多行輸入框-->
                                        </div>
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button class="btn btn-primary btn-sm" type="submit">儲存</button>
                                        </div>


                            </div>
                                    <script type="text/javascript">
                                        function del(obj){
                                            if(document.getElementById('tbodyid').children.length>1){
                                                var trid=obj.parentNode.parentNode.id;
                                                var objtr=document.getElementById(trid);
                                                document.getElementById('tbodyid').removeChild(objtr);
                                                var tbody=document.getElementById('tbodyid');
                                                var countchildren=tbody.childElementCount;
                                                for (var i=0;i<countchildren;i++){
                                                    tbody.children[i].children[0].innerHTML=i+1;
                                                }
                                            }
                                            else{
                                                alert("請不要全部刪除");
                                            }
                                        }
                                        function add(){
                                            var trid = new Date().getTime();
                                            var packageid=trid+'packageid';
                                            var countid=trid+'countid';
                                            var priceid=trid+'priceid';
                                            var objtr=document.createElement('tr');
                                            objtr.id=trid;
                                            objtr.innerHTML="<td></td> " +
                                                "      <td><input id='"+trid+"packageid'></td> " +
                                                "      <td><textarea id='"+trid+"countid'></textarea></td> " +
                                                "      <td><input id='"+trid+"priceid'></td> " +
                                                "      <td><button type='button' onclick='del(this)'>刪除</button></td>";
                                            document.getElementById("tbodyid").appendChild(objtr);
                                            var tbodyobj=document.getElementById('tbodyid');
                                            var countchildren=tbodyobj.childElementCount;
                                            for (var i=0;i<countchildren;i++){
                                                tbodyobj.children[i].children[0].innerHTML=i+1;
                                            }
                                        }
                                        function save(){
                                            var tbodyobj=document.getElementById('tbodyid');
                                            var countchildren=tbodyobj.childElementCount;
                                            var trid="";
                                            var packageid="";
                                            var countid="";
                                            var priceid="";
                                            var list=new Array();
                                            for (var i=0;i<countchildren;i++){
                                                trid=tbodyobj.children[i].id;
                                                packageid=trid+"packageid";
                                                countid=trid+"countid";
                                                priceid=trid+"priceid";
                                                var map={
                                                    "套餐":document.getElementById(packageid).value,
                                                    "內容":document.getElementById(countid).value,
                                                    "價格":document.getElementById(priceid).value
                                                }
                                                list.push(map);
                                            }
                                            console.log("list:",list);
                                            alert(JSON.stringify(list));
                                        }
                                    </script>
                                    <body>
                                    <div>
                                        <div style="width: 80%;margin: 10%">
                                            <table border="1" bordercolor="#a0c6e5" style="border-collapse:collapse;" align="center" width="100%">
                                                <caption>動態增加表格</caption>
                                                <thead>
                                                <tr>
                                                    <th width="5% ">序號</th>
                                                    <th width="20%">套餐</th>
                                                    <th width="30%">內容</th>
                                                    <th width="10%">價格</th>
                                                    <th width="10%">操作</th>
                                                </tr>
                                                </thead>
                                                <tbody id="tbodyid">
                                                <tr id="123">
                                                    <td>1</td>
                                                    <td><input id="123packageid"></td>
                                                    <td><textarea id="123countid"></textarea></td>
                                                    <td><input id="123priceid"></td>
                                                    <td><button type="button" onclick='del(this)'>刪除</button></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <button type="button" onclick='add()'>新增</button>
                                            <button type="button" onclick='save()'>儲存</button>
                                        </div>
                                    </div>
                                    </body>
                                    </html>

@endsection
