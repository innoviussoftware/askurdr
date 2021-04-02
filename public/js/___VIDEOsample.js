var global_username = '';


/*** After successful authentication, show user interface ***/

var showUI = function() {
	$('div#call').show();
	$('form#userForm').css('display', 'none');
	$('div#userInfo').css('display', 'inline');
	$('h3#login').css('display', 'none');
	$('video').show();
	$('span#username').text(global_username);
}


/*** If no valid session could be started, show the login interface ***/

var showLoginUI = function() {
	$('form#userForm').css('display', 'inline');
}


//*** Set up sinchClient ***/

sinchClient = new SinchClient({
	applicationKey: '37c64563-a2f6-467a-8c6f-bc7f562ba079',
	capabilities: {calling: true, video: true},
	supportActiveConnection: true,
	setSupportManagedPush:true,
	onLogMessage: function(message) {
		console.log(message);
	},
});

sinchClient.startActiveConnection();

/*** Name of session, can be anything. ***/

var sessionName = 'sinchSessionVIDEO-' + sinchClient.applicationKey;


/*** Check for valid session. NOTE: Deactivated by default to allow multiple browser-tabs with different users. ***/

var sessionObj = JSON.parse(localStorage[sessionName] || '{}');
var sinch_ticket = document.getElementById('sinch_ticket').value;
if(sessionObj.userId) {
	sinchClient.start(sessionObj)
		.then(function() {
			global_username = sessionObj.userId;
			//On success, show the UI
			showUI();
			$(".videocall_screen_loader").hide();
			//Store session & manage in some way (optional)
			localStorage[sessionName] = JSON.stringify(sinchClient.getSession());
		})
		.fail(function() {
			//No valid session, take suitable action, such as prompting for username/password, then start sinchClient again with login object
			showLoginUI();
			$(".videocall_screen_loader").hide();

		});
} else if(sinch_ticket != ''){
		sinchClient.start({ userTicket: sinch_ticket }, function() {
			showUI();
			$(".videocall_screen_loader").hide();
			localStorage[sessionName] = JSON.stringify(sinchClient.getSession());
		}).fail(function() {
			showLoginUI();
			$(".videocall_screen_loader").hide();

		});
} else {
	showLoginUI();
	$(".videocall_screen_loader").hide();

}


/*** Create user and start sinch for that user and save session in localStorage ***/

$('button#createUser').on('click', function(event) {
	event.preventDefault();
	$('button#loginUser').attr('disabled', true);
	$('button#createUser').attr('disabled', true);
	clearError();

	var signUpObj = {};
	signUpObj.username = $('input#username').val();
	signUpObj.password = $('input#password').val();

	//Use Sinch SDK to create a new user
	sinchClient.newUser(signUpObj, function(ticket) {
		console.log(ticket);
		//On success, start the client
		sinchClient.start(ticket, function() {
			global_username = signUpObj.username;
			//On success, show the UI
			showUI();

			//Store session & manage in some way (optional)
			localStorage[sessionName] = JSON.stringify(sinchClient.getSession());
		}).fail(handleError);
	}).fail(handleError);
});


/*** Login user and save session in localStorage ***/

$('button#loginUser').on('click', function(event) {
	event.preventDefault();
	$('button#loginUser').attr('disabled', true);
	$('button#createUser').attr('disabled', true);
	clearError();

	var signInObj = {};
	signInObj.username = $('input#username').val();
	signInObj.password = $('input#password').val();

	//Use Sinch SDK to authenticate a user
	sinchClient.start(signInObj, function() {
		global_username = signInObj.username;
		//On success, show the UI
		showUI();

		//Store session & manage in some way (optional)
		localStorage[sessionName] = JSON.stringify(sinchClient.getSession());
	}).fail(handleError);
});

/*** Create audio elements for progresstone and incoming sound */
const audioProgress = document.createElement('audio');
const audioRingTone = document.createElement('audio');
const videoIncoming = document.getElementById('videoincoming');
const videoOutgoing = document.getElementById('videooutgoing');

/*** Define listener for managing calls ***/
var callListeners = {
	onCallProgressing: function(call) {
		audioProgress.src = './js/ringback.wav';
		audioProgress.loop = true;
		audioProgress.play();
		videoOutgoing.srcObject = call.outgoingStream;

		//Report call stats
		$('div#callLog').append('<div id="stats">Ringing...</div>');
	},
	onCallEstablished: function(call) {
		videoIncoming.srcObject = call.incomingStream;
		videoOutgoing.srcObject = call.outgoingStream;
		audioProgress.pause();
		audioRingTone.pause();
		//Report call stats
		var callDetails = call.getDetails();
		$('div#callLog').append('<div id="stats">Answered at: '+(callDetails.establishedTime && new Date(callDetails.establishedTime))+'</div>');
	},
	onCallEnded: function(call) {
		audioProgress.pause();
		audioRingTone.pause();
		videoIncoming.srcObject = null;
		videoOutgoing.srcObject = null;

		$('button').removeClass('incall');
		$('button').removeClass('callwaiting');

		//Report call stats
		var callDetails = call.getDetails();
		$('div#callLog').append('<div id="stats">Ended: '+new Date(callDetails.endedTime)+'</div>');
		$('div#callLog').append('<div id="stats">Duration (s): '+callDetails.duration+'</div>');
		$('div#callLog').append('<div id="stats">End cause: '+call.getEndCause()+'</div>');
		if(call.error) {
			$('div#callLog').append('<div id="stats">Failure message: '+call.error.message+'</div>');
		}
	}
}

/*** Set up callClient and define how to handle incoming calls ***/

var callClient = sinchClient.getCallClient();
callClient.initStream().then(function() { // Directly init streams, in order to force user to accept use of media sources at a time we choose
	$('div.frame').not('#chromeFileWarning').show();
});
var call;

callClient.addEventListener({
  onIncomingCall: function(incomingCall) {
	//Play some groovy tunes
	audioRingTone.src = './js/phone_ring.wav';
	audioRingTone.loop = true;
	audioRingTone.play();

	//Print statistics
	$('.videocall_screen').show();
	getUserEmr(incomingCall.fromId);
	// $('div#callLog').append('<div id="title">Incoming call from ' + incomingCall.fromId + '</div>');
	$('div#callLog').append('<div id="title">Incoming call from </div>');
	$('div#callLog').append('<div id="stats">Ringing...</div>');
	$('button').addClass('incall');

	//Manage the call object
    call = incomingCall;
    call.addEventListener(callListeners);
	$('button').addClass('callwaiting');

	//call.answer(); //Use to test auto answer
	//call.hangup();
  }
});
$('body').on("click", "#close_videoscreen", function (){
	$("button#hangup").click();
	$(".videocall_screen").hide();
});

$('button#answer').click(function(event) {
	event.preventDefault();

	if($(this).hasClass("callwaiting")) {
		clearError();

		try {
			call.answer();
			$('button').removeClass('callwaiting');
		}
		catch(error) {
			handleError(error);
		}
	}
});

/*** Make a new data call ***/

$('button#call').click(function(event) {
	event.preventDefault();

	if(!$(this).hasClass("incall") && !$(this).hasClass("callwaiting")) {
		clearError();

		$('button').addClass('incall');

		$('div#callLog').append('<div id="title">Calling ' + $('input#callUserName').val()+'</div>');

		console.log('Placing call to: ' + $('input#callUserName').val());
		call = callClient.callUser($('input#callUserName').val());

		call.addEventListener(callListeners);
	}
});

$('body').on("click", ".videocall_btn", function (){

	var user_id = $(this).val();
	getUserEmr(user_id);
	$.ajax({
		url:"./send_video_push/"+user_id,
		method:"get",
		success:function(e){
			console.log("Send PUSH");
			console.log(e);
		}
	});
	$(".videocall_screen").show();

		if(!$(this).hasClass("incall") && !$(this).hasClass("callwaiting")) {
			// clearError();
			//
			$('button').addClass('incall');

			$('div#callLog').append('<div id="title">Calling ' + user_id +'</div>');

			console.log('Placing call to: ' + user_id);
			call = callClient.callUser(user_id);

			call.addEventListener(callListeners);
		}
	});

/*** Hang up a call ***/

// $('button#hangup').click(function(event) {
$("body").on("click","button#hangup",function (){

	event.preventDefault();

	if($(this).hasClass("incall")) {
		clearError();

		console.info('Will request hangup..');

		call && call.hangup();
	}
});

/*** Log out user ***/

$('button#logOut').on('click', function(event) {
	event.preventDefault();
	clearError();

	//Stop the sinchClient
	sinchClient.terminate();
	//Note: sinchClient object is now considered stale. Instantiate new sinchClient to reauthenticate, or reload the page.

	//Remember to destroy / unset the session info you may have stored
	delete localStorage[sessionName];

	//Allow re-login
	$('button#loginUser').attr('disabled', false);
	$('button#createUser').attr('disabled', false);

	//Reload page.
	window.location.reload();
});


/*** Handle errors, report them and re-enable UI ***/

var handleError = function(error) {
	//Enable buttons
	$('button#createUser').prop('disabled', false);
	$('button#loginUser').prop('disabled', false);

	//Show error
	$('div.error').text(error.message);
	$('div.error').show();
}

/** Always clear errors **/
var clearError = function() {
	$('div.error').hide();
}

/** Chrome check for file - This will warn developers of using file: protocol when testing WebRTC **/
if(location.protocol == 'file:' && navigator.userAgent.toLowerCase().indexOf('chrome') > -1) {
	$('div#chromeFileWarning').show();
}

$('button').prop('disabled', false); //Solve Firefox issue, ensure buttons always clickable after load

function getUserEmr(phone){
	$.ajax({
		url:"/api/get/user/emr/"+phone,
		type:"get",
		success:function (e){
			// console.log(e);
			$("#patient_id").val(e.patient_id);
			$("#type_visit").val(e.type_visit);
			$("#emr_number").val(e.emr_number);
			$("#type_visit_label").html(e.type_visit);
		}
	});
}
