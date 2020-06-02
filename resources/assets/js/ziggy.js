    var Ziggy = {
        namedRoutes: {"login":{"uri":"login","methods":["GET","HEAD"],"domain":null},"logout":{"uri":"logout","methods":["GET","HEAD"],"domain":null},"register":{"uri":"register","methods":["GET","HEAD"],"domain":null},"password.request":{"uri":"password\/reset","methods":["GET","HEAD"],"domain":null},"password.email":{"uri":"password\/email","methods":["POST"],"domain":null},"password.reset":{"uri":"password\/reset\/{token}","methods":["GET","HEAD"],"domain":null},"password.update":{"uri":"password\/reset","methods":["POST"],"domain":null},"password.confirm":{"uri":"password\/confirm","methods":["GET","HEAD"],"domain":null},"home":{"uri":"dashboard","methods":["GET","HEAD"],"domain":null},"activitylog.index":{"uri":"api\/activitylog\/list","methods":["GET","HEAD"],"domain":null},"activitylog.show":{"uri":"api\/activitylog\/{activitylog}\/read","methods":["GET","HEAD"],"domain":null},"permission.index":{"uri":"api\/permission\/list","methods":["GET","HEAD"],"domain":null},"permission.store":{"uri":"api\/permission\/store","methods":["POST"],"domain":null},"permission.show":{"uri":"api\/permission\/{permission}\/read","methods":["GET","HEAD"],"domain":null},"permission.update":{"uri":"api\/permission\/{permission}\/update","methods":["PUT","PATCH"],"domain":null},"permission.destroy":{"uri":"api\/permission\/{permission}\/delete","methods":["DELETE"],"domain":null},"permission.checkboxes":{"uri":"api\/permission\/checkboxes","methods":["GET","HEAD"],"domain":null},"role.index":{"uri":"api\/role\/list","methods":["GET","HEAD"],"domain":null},"role.store":{"uri":"api\/role\/store","methods":["POST"],"domain":null},"role.show":{"uri":"api\/role\/{role}\/read","methods":["GET","HEAD"],"domain":null},"role.update":{"uri":"api\/role\/{role}\/update","methods":["PUT","PATCH"],"domain":null},"role.destroy":{"uri":"api\/role\/{role}\/delete","methods":["DELETE"],"domain":null},"role.checkboxes":{"uri":"api\/role\/checkboxes","methods":["GET","HEAD"],"domain":null},"setting.index":{"uri":"api\/setting\/list","methods":["GET","HEAD"],"domain":null},"setting.store":{"uri":"api\/setting\/store","methods":["POST"],"domain":null},"setting.show":{"uri":"api\/setting\/{setting}\/read","methods":["GET","HEAD"],"domain":null},"setting.update":{"uri":"api\/setting\/{setting}\/update","methods":["PUT","PATCH"],"domain":null},"setting.destroy":{"uri":"api\/setting\/{setting}\/delete","methods":["DELETE"],"domain":null},"setting.dropdown":{"uri":"api\/setting\/dropdown","methods":["GET","HEAD"],"domain":null},"user.index":{"uri":"api\/user\/list","methods":["GET","HEAD"],"domain":null},"user.store":{"uri":"api\/user\/store","methods":["POST"],"domain":null},"user.show":{"uri":"api\/user\/{user}\/read","methods":["GET","HEAD"],"domain":null},"user.update":{"uri":"api\/user\/{user}\/update","methods":["PUT","PATCH"],"domain":null},"user.destroy":{"uri":"api\/user\/{user}\/delete","methods":["DELETE"],"domain":null},"user.updatePassword":{"uri":"api\/user\/{user}\/updatePassword","methods":["PUT","PATCH"],"domain":null}},
        baseUrl: 'https://vm.vueadmin.com/',
        baseProtocol: 'https',
        baseDomain: 'vm.vueadmin.com',
        basePort: false,
        defaultParameters: []
    };

    if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
        for (var name in window.Ziggy.namedRoutes) {
            Ziggy.namedRoutes[name] = window.Ziggy.namedRoutes[name];
        }
    }

    export {
        Ziggy
    }
