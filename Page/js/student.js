function initStu() {
    $.post("../stuLogic/overViewStuInfo.php", function (callbackData) {
        $('.stu-info').html(callbackData);
        alterStuFunction();
    })
}

$(function(){
    initStu();

    let adminSelect = $("#admin_button");
    let stuSelect = $("#student_button");

    stuSelect.on('click', function () {
        if(!stuSelect.hasClass('active')) {
            console.log('stuSelect');

            stuSelect.addClass('active')
            $('.stu-info').removeClass('hidden')
            adminSelect.removeClass('active')
            $('.admin-info').addClass('hidden')
            initStu();
        }
    })

    adminSelect.on('click', function () {
        if(!adminSelect.hasClass('active')) {
            console.log('adminSelect')

            stuSelect.removeClass('active')
            $('.stu-info').addClass('hidden')
            adminSelect.addClass('active')
            $('.admin-info').removeClass('hidden')

            $.post("../stuLogic/overViewAdminInfo.php", function (callbackData) {
                $('.admin-info').html(callbackData)
            })
        }
    })
});

function alterStuFunction() {
    let alterInfo = $('.alter-stu-info')
    let post = {}
    alterInfo.click(function () {
        console.log('alterInfo')

        // 同时传输楼号和楼层，会有相同楼号而无法确定
        let parentTr = $(this).closest("tr");
        let brotherTh = parentTr.find("th"); // 其余th兄弟节点

        // 形成json时排除最后一个元素
        for(let i = 0; i < brotherTh.length - 1; i++) {
            // classList 0 -> 2
            post[brotherTh[i].classList[0]] = brotherTh[i].innerText;
        }

        $.post('../stuLogic/requestStuForm.php', post, function (callbackData) {
            parentTr.html(callbackData)

            inputDisable()
            doneFunction()
            cancelAlterFunction()

        });
    });
}

// 输入窗口可更改性来提示用户不可输入，MySql更新来防止攻击
function inputDisable() {
    let inputDiv = $('body').find('input');
    // console.log(inputDiv);
    for(let i = 0; i < inputDiv.length; i ++) {
        let currentInput = inputDiv[i];
        // console.log(inputDiv[i]);
        // 禁用按钮
        if(currentInput.name !== 'Spasswd' && currentInput.name !== 'Sdepartment' &&
            currentInput.name !== 'Sclass' && currentInput.name !== 'Stel' && currentInput.name !== 'Saddress' ) {
            jQuery(currentInput).attr('disabled','disabled');
        }
    }
}

// 确认
function doneFunction() {
    let doneAlterInfo = $('#doneAlterStuInfo');
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
        $.post('../stuLogic/alterStuInfo.php', post);


        // let findInfo = $("#findInfo");
        // let form = $("#form_select").serializeArray(); // $("[name='theName']");
        // console.log(form);
        // flushTableByMainForm();
        // 刷新
        initStu();
        // $.post("../stuLogic/overViewStuInfo.php", function (callbackData) {
        //     $('.stu-info').html(callbackData);
        //     alterStuFunction()
        // })

        // queryTable(form, "");
        // $.post("adminSelect/selectBuild.php", form, function (callbackData){
        //     $("#can_be_load_div").html(callbackData)
        // });
    });
}

function cancelAlterFunction() {
    $('#cancelAlterInfo').on('click', function () {
        initStu();
    })
}