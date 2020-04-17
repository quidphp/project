// app
// main JavaScript file for the app

// mountInitial
// initial mount point, is only fired on page load
ael(document, 'doc:mountInitial', function(event, body) {

});

// mountCommon
// fired every time a page or component injects new html
ael(document, 'doc:mountCommon', function(event, node) {

});

// mountPage
// fired when a page is loaded
ael(document, 'doc:mountPage', function(event, node) {

});

// home
// fired when home page is triggered
ael(document, 'route:home', function(event, node) {

});