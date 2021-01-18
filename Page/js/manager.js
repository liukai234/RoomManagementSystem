$(function () {
    initAdmin();

    let adminIsSelect = $("#admin_button")
    let roomIsSelect = $("#room_button")
    let inIsSelect = $("#in_button")

    adminIsSelect.on('click', function () {
        if (!adminIsSelect.hasClass("active")) {
            console.log("#admin_buttonIsSelect")
            adminIsSelect.addClass('active')
            roomIsSelect.removeClass('active')
            inIsSelect.removeClass('active')

            $('.admin-info').removeClass('hidden')
            $('.room_info').addClass('hidden')
            $('.in_info').addClass('hidden')
            initAdmin();
        }
    })

    roomIsSelect.click(function () {
        if (!roomIsSelect.hasClass("active")) {
            roomIsSelect.addClass('active');
            adminIsSelect.removeClass('active');
            inIsSelect.removeClass('active');

            $('.room_info').removeClass('hidden');
            $('.admin-info').addClass('hidden');
            $('.in_info').addClass('hidden');
        }
    })

    inIsSelect.click(function () {
        if (!inIsSelect.hasClass("active")) {
            inIsSelect.addClass('active')
            roomIsSelect.removeClass('active')
            adminIsSelect.removeClass('active')

            $('.in_info').removeClass('hidden')
            $('.admin-info').addClass('hidden')
            $('.room_info').addClass('hidden')

            console.log("in_button");
            requestNotAtForm();
        }
    })

    notAtFilter();
})

function initAdmin() {
    $.post("../adminSelect/adminLogic/overViewAdminInfo.php", function (callbackData) {
        $('.admin-info').html(callbackData)
        alterAdminFunction()
    })
}

function alterAdminFunction() {
    let alterInfo = $('.alter-admin-info')
    let post = {}
    alterInfo.click(function () {
        console.log('alterInfo')
        let parentTr = $(this).closest("tr");
        let brotherTh = parentTr.find("th");

        // 形成json时排除最后一个元素
        for(let i = 0; i < brotherTh.length - 1; i++) {
            post[brotherTh[i].classList[0]] = brotherTh[i].innerText;
        }

        $.post('../adminSelect/adminLogic/requestAdminForm.php', post, function (callbackData) {
            parentTr.html(callbackData)

            inputAdminDisable()
            doneFunction()
            cancelAlterAdminFunction()

        });
    });
}

// TODO .admin-info 函数更名 与可更改学生数据重名
function inputAdminDisable() {
    let inputDiv = $('.admin-info').find('input');
    // console.log(inputDiv);
    for(let i = 0; i < inputDiv.length; i ++) {
        let currentInput = inputDiv[i];
        // console.log(inputDiv[i]);
        // 禁用按钮
        if(currentInput.name === 'Ano') {
            jQuery(currentInput).attr('disabled','disabled');
        }
    }
}

function doneFunction() {
    let doneAlterInfo = $('#doneAlterAdminInfo');
    let post = {};
    doneAlterInfo.click(function () {
        console.log('doneAlterInfo');
        let alterInfo = $(doneAlterInfo).closest("tr");
        let formAlterInfo = alterInfo.find("input");

        for(let i = 0; i < formAlterInfo.length; i++) {
            post[formAlterInfo[i].name] = formAlterInfo[i].value;
        }
        // console.log(post);
        // $.post("adminSelect/alterRoomInfo.php", post);
        $.post('../adminSelect/adminLogic/alterAdminInfo.php', post);

        initAdmin()
    })
}

function cancelAlterAdminFunction() {
    $('#cancelAlterInfo').on('click', function () {
        initAdmin();
    })
}

function requestNotAtForm(post) {
    $.post('adminSelect/notAtInfoThead.php', '', function (callbackData) {
        $("#not-at-info thead tr").html(callbackData)
    })
    $.post('adminSelect/notAtInfoTbody.php', post, function (callbackData) {
        $("#not-at-info tbody").html(callbackData)
        setIn()
    })
}

function setIn() {
    let setIn = $("#not-at-info").find(".set-in");
    setIn.on('click', function (callbackInfo) {
        // 按钮判断
        console.log("setInBtn");
        let post = {};

        // 同时传输楼号和楼层，会有相同楼号而无法确定
        let parentTr = $(this).closest("tr")
        let brotherTh = parentTr.find("th") // 其余th兄弟节点

        // 形成json时排除最后一个元素
        for (let i = 0; i < brotherTh.length - 1; i++) {
            // classList 0 -> 2
            post[brotherTh[i].classList[0]] = brotherTh[i].innerText
        }
        
        $.post("adminSelect/alterAtInfo.php", post);
            flushBuFilterInput()        // requestNotAtForm();
    })

}

$(document).ready(function () {
    let stayIsSelect = $("#stay_button");
    stayIsSelect.click(function () {
        if (!stayIsSelect.hasClass("active")) {
            $('#stay_button').addClass('active');
            $('#admin_button').removeClass('active');
            $('#room_button').removeClass('active');
            $('#in_button').removeClass('active');

            $('.stay_info').removeClass('hidden');
            $('.admin-info').addClass('hidden');
            $('.room_info').addClass('hidden');
            $('.in_info').addClass('hidden');
        }
    });
});


// let alterRoomInfo;

$(function () {
    initOverViewFunction();

    overViewFunction();
    findInfoFunction();

    // rowAlterFunction();
    // rowDoneFunction();


    addBtnFunction($("#addRoomBtn"), $("#addRoomForm"), $("#addStuBtn"), $("#addRoomSubmitBtn"), $("#addRoomSubmitCancelBtn"));
    addBtnFunction($("#addStuBtn"), $("#addStuForm"), $("#addRoomBtn"), $("#addStuSubmitBtn"), $("#addStuSubmitCancelBtn"));
})



function tipsSessionFunction(form) {
    let tipsSession = $("#tips-session");
    console.log("tips-session", tipsSession);
    $.post("adminSelect/tipsSession.php", form, function (callbackData) {
        tipsSession.html(callbackData);
    })
}

function initOverViewFunction() {
    console.log("initOverViewFunction");

    let tipsSession = $("#tips-session");
    tipsSession.html("宿舍楼分配情况概览");

    queryTable('', "adminSelect/overViewThead.php", "adminSelect/overViewTbody.php");
}

function overViewFunction() {
    let overView = $("#overView");
    overView.on("click", function () {
        console.log(overView[0].id);
        initOverViewFunction();
    });
}


let theadTr = $("#default_build_info thead tr");
let tbody = $("#default_build_info tbody");
// 只能用于发送，不可使用回调
function queryTable(post, fileThead, fileTbody) {
    console.log("queryTable", post);



    $.post(fileThead, post, function (callbackData) {
        theadTr.html(callbackData);
    })

    $.post(fileTbody, post, function (callbackData) {
        tbody.html(callbackData);
    })
}

// TODO 可以合并至alter方法中
function delRow(delName) {
    let del = $(delName);
    let post = {}
    del.on('dblclick', function () {
        console.log("deLRow");

        let parentTr = $(this).closest("tr");
        let brotherTh = parentTr.find("th"); // 其余th兄弟节点

        // 形成json时排除最后一个元素
        for(let i = 0; i < brotherTh.length - 1; i++) {
            // classList 0 -> 2
            post[brotherTh[i].classList[0]] = brotherTh[i].innerText;
        }

        if (delName === ".delRoomInfo") {
            $.post('adminSelect/delRow/delRoomRow.php', post, function (callbackData) {
                flushTableByMainForm();
            });

        } else if (delName === ".delStuInfo") {
            $.post('adminSelect/delRow/delStuRow.php', post, function(callbackData) {
                flushTableByMainForm();
                // console.log(post);
                // console.log(callbackData);
            });
        }

    })
}

function findInfoFunction() {
    let findInfo = $("#findInfo");
    findInfo.click(function () {
        console.log(findInfo[0].id);
        flushTableByMainForm();
    })
}

function flushTableByMainForm() {
    // 输出以数组形式序列化表单值的结果
    let form = $("#form_select").serializeArray();
    console.log("flushTableByMainForm");

    tipsSessionFunction(form);
    // queryTable(form, "adminSelect/queryThead.php", "adminSelect/queryTbody.php");
    // rowAlterFunction(); // 更新 .alterRoomInfo DOM信息
    $.post("adminSelect/queryThead.php", form, function (callbackData) {
        theadTr.html(callbackData);
    });

    // let tbody = $("#default_build_info tbody");
    $.post("adminSelect/queryTbody.php", form, function (callbackData) {
        tbody.html(callbackData);
        rowAlterFunction(".alterRoomInfo", "adminSelect/requestRoomForm.php");
        rowAlterFunction(".alterStuInfo", "adminSelect/requestStuForm.php");
        delRow(".delRoomInfo");
        delRow(".delStuInfo");
    })
}

// function roomAlterFunction() {
// function stuAlterFunction() {

// 修改
// function rowAlterFunction() {
//     let alterRoomInfo = $(".alterRoomInfo");
//     // 按钮判断
//     console.log(alterRoomInfo);
//     let post = {};
//     alterRoomInfo.click(function () {
//         console.log(".alterRoomInfo");
//
//         // 同时传输楼号和楼层，会有相同楼号而无法确定
//         let parentTr = $(this).closest("tr");
//         let brotherTh = parentTr.find("th"); // 其余th兄弟节点
//
//         // 形成json时排除最后一个元素
//         for(let i = 0; i < brotherTh.length - 1; i++) {
//             // classList 0 -> 2
//             post[brotherTh[i].classList[0]] = brotherTh[i].innerText;
//         }
//
//         // console.log(post);
//         $.post("adminSelect/requestRoomForm.php", post, function (callbackData) {
//             parentTr.html(callbackData);
//             rowDoneFunction(); // 更新 doneAlterRoomInfo DOM信息
//         });
//     });
// }

function rowAlterFunction($alterInfoName, $requestFile) {
// let alterInfo = $(".alterRoomInfo");
    let alterInfo = $($alterInfoName);
// 按钮判断
    console.log(alterInfo);
    let post = {};


    alterInfo.click(function () {
        console.log($alterInfoName);

        // 同时传输楼号和楼层，会有相同楼号而无法确定
        let parentTr = $(this).closest("tr");
        let brotherTh = parentTr.find("th"); // 其余th兄弟节点

        // 形成json时排除最后一个元素
        for (let i = 0; i < brotherTh.length - 1; i++) {
            // classList 0 -> 2
            post[brotherTh[i].classList[0]] = brotherTh[i].innerText;
        }

        // console.log(post);
        $.post($requestFile, post, function (callbackData) {
            parentTr.html(callbackData);
            inputDisable();
            if ($alterInfoName === ".alterRoomInfo") {
                rowDoneFunction("#doneAlterRoomInfo", "adminSelect/alterRoomInfo.php"); // 更新 doneAlterRoomInfo DOM信息
            } else if ($alterInfoName === ".alterStuInfo") {
                rowDoneFunction("#doneAlterStuInfo", "adminSelect/alterStuInfo.php"); // 更新 doneAlterRoomInfo DOM信息
            }
            cancelAlterFunction();
        });
    });
}

// 确认
function rowDoneFunction($doneName, $requestFile) {
    // let doneAlterRoomInfo = $("#doneAlterRoomInfo");
    let doneAlterInfo = $($doneName);
    let post = {};
    doneAlterInfo.click(function () {
        console.log(doneAlterInfo[0].id);
        let alterRoomInfo = $(doneAlterInfo).closest("tr");
        let formAlterInfo = alterRoomInfo.find("input");

        for(let i = 0; i < formAlterInfo.length; i++) {
            post[formAlterInfo[i].name] = formAlterInfo[i].value;
        }
        // console.log(post);
        // $.post("adminSelect/alterRoomInfo.php", post);
        $.post($requestFile, post);


        // let findInfo = $("#findInfo");
        // let form = $("#form_select").serializeArray(); // $("[name='theName']");
        // console.log(form);
        flushTableByMainForm();
        // queryTable(form, "");
        // $.post("adminSelect/selectBuild.php", form, function (callbackData){
        //     $("#can_be_load_div").html(callbackData)
        // });
    });
}
// 确认
// function rowDoneFunction() {
//     let doneAlterRoomInfo = $("#doneAlterRoomInfo");
//
//     let post = {};
//     doneAlterRoomInfo.click(function () {
//         console.log(doneAlterRoomInfo[0].id);
//         let alterRoomInfo = $(doneAlterRoomInfo).closest("tr");
//         let formAlterRoomInfo = alterRoomInfo.find("input");
//
//         for(let i = 0; i < formAlterRoomInfo.length; i++) {
//             post[formAlterRoomInfo[i].name] = formAlterRoomInfo[i].value;
//         }
//         // console.log(post);
//         $.post("adminSelect/alterRoomInfo.php", post);
//
//
//         let findInfo = $("#findInfo");
//         let form = $("#form_select").serializeArray(); // $("[name='theName']");
//         // console.log(form);
//         flushTableByMainForm();
//         // queryTable(form, "");
//         // $.post("adminSelect/selectBuild.php", form, function (callbackData){
//         //     $("#can_be_load_div").html(callbackData)
//         // });
//     });
// }

function cancelAlterFunction() {
    $("#cancelAlterInfo").on('click', function () {
        flushTableByMainForm();
    })
}

function addBtnFunction(addBtn, addForm, addSubBtn, addSubmitBtn, addSubmitCancelBtn) {
    addBtn.on('click', function () {
        if (!addBtn.hasClass('disabled')) {
            addForm.removeClass('hidden');
            addSubBtn.addClass('disabled');
            addBtn.addClass('disabled');
        }
    });

    let post = {};

    // 取消
    addSubmitCancelBtn.on("click", function () {
        addBtn.removeClass('disabled');
        addSubBtn.removeClass('disabled');
        addForm.addClass('hidden');

        post = {}; // 清空post
    })

    addSubmitBtn.on("click", function () {
        addBtn.removeClass('disabled');
        addSubBtn.removeClass('disabled');
        addForm.addClass('hidden');

        let addRoomFormInput = addForm.find("input");
        for (let i = 0; i < addRoomFormInput.length; i++) {
            post[addRoomFormInput[i].name] = addRoomFormInput[i].value;
            console.log(post[addRoomFormInput[i].name], addRoomFormInput[i].value)
        }

        if (addBtn[0].id === "addRoomBtn") {
            $.post("adminSelect/addRoom.php", post);
        } else if (addBtn[0].id === "addStuBtn") {
            console.log("===");
            $.post("adminSelect/addStu.php", post);
        }
        flushTableByMainForm()
        // flushCanBeLoadDiv();
    })
}

function flushCanBeLoadDiv() {
    let form = $("#form_select").serializeArray(); // $("[name='theName']");
    // queryTable(form);
    queryTable(form, "adminSelect/queryThead.php", "adminSelect/queryTbody.php");
    // $.post("adminSelect/selectBuild.php", form, function (callbackData) { //.default_build_info
    //     $("#can_be_load_div").html(callbackData);
    // });
}

// TODO 调整可更改数据
function inputDisable() {
    let inputDiv = $('#default_build_info tbody tr th').find('input');
    // console.log(inputDiv);
    for(let i = 0; i < inputDiv.length; i ++) {
        let currentInput = inputDiv[i];
        // console.log(inputDiv[i]);
        // 禁用按钮
        /*if(currentInput.name !== 'Sname' && currentInput.name !== 'Stel' && currentInput.name !== 'Saddress' && currentInput.name !== 'Bno' &&
            currentInput.name !== 'Rno' && currentInput.name !== 'Rcapacity' && currentInput.name !== 'Rfloor'
        ) {
            jQuery(currentInput).attr('disabled','disabled');
        }*/
    }
}

function flushBuFilterInput() {
    let filterInput = $('.in_info input')
    let post = {}
    post['filterInput'] = filterInput.val();
    // console.log(filterInput.val())
    requestNotAtForm(post)
}

function notAtFilter() {
    let filterForm = $('.in_info form')
    let filterInput = $('.in_info input')


    filterInput.datepicker({
        dateFormat: 'yy/mm/dd'
    })
    filterForm.on('submit', function (e) {
        let post = {}
        e.preventDefault()
        console.log("submitBtn")
        if(filterInput.val() === '') {
            requestNotAtForm('')
        } else {
            post['filterInput'] = filterInput.val();
            // console.log(filterInput.val())
            requestNotAtForm(post)
        }
    })
}