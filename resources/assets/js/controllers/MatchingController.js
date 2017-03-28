window.MatchingController = function () {
};

window.MatchingController.prototype = function () {
    var matchMentorButtonHandler = function () {
            $("body").on("click", ".matchMentorBtn", function (e) {
                e.stopPropagation();
                var menteeId = $(this).attr("data-menteeId");
                var menteeFullName = $(this).attr("data-userName");
                console.log(menteeId);
                $('#matchMentorModal').modal('toggle');
                $('#matchMentorModal').find('input[name="mentee_id"]').val(menteeId);
                $('#menteeFullName').html(menteeFullName);
            });
        },
        initHandlers = function() {
            matchMentorButtonHandler();
        },
        init = function () {
            initHandlers();
        };
    return {
        init: init
    }
}();
