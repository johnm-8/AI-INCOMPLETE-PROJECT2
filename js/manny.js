window.watsonAssistantChatOptions = {
    integrationID: "5f8cd6dc-7d6c-4f0a-a2db-30f36003e035", // The ID of this integration.
    region: "us-east", // The region your integration is hosted in.
    serviceInstanceID: "4ce27797-662a-46f2-8c6c-d94028a87bcc", // The ID of your service instance.
    onLoad: function(instance) { instance.render(); }
};
setTimeout(function(){
    const t=document.createElement('script');
    t.src="https://web-chat.global.assistant.watson.appdomain.cloud/versions/" + (window.watsonAssistantChatOptions.clientVersion || 'latest') + "/WatsonAssistantChatEntry.js";
    document.head.appendChild(t);
});
