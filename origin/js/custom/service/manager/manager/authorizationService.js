app.factory('authorizationService',['$q', function($q){

    var authorizationLinkagesStatus = {
        /*** Product */
        'New Product Combo':false, 'All Product Combos':false, 'Edit Product Combo':false, 'New Product Feature':false, 'All Product Features':false, 'Edit Product Feature':false, 'New Plan':false, 'All Plans':false, 'Edit Plan':false, 'New Device':false, 'All Devices':false, 'Edit Device':false,
        /*** Service */
        'New Service':false, 'All Services':false, 'All Provisions':false,
        /*** Billing */
        'New Billing':false, 'All Billings':false, 'New Invoice':false, 'All Invoices':false,
        /*** Sales */
        'New Sales':false, 'All Sales':false, 'All Sell':false, 'All Commission':false,
        /*** Manager */
        'New Manager':false, 'All Managers':false, 'Edit Manager':false,
        /*** Contact Us */
        'All Messages':false, 'Edit Message':false
    };

    function getAuthorizationLinkagesStatus()
    {
        return authorizationLinkagesStatus;
    }

    function getAuthorizationLinkagesPath()
    {
        return {
            /*** Product */
            'New Product Combo':'/manager/product/product_combo/new', 'All Product Combos':'/manager/product/product_combo/all', 'Edit Product Combo':'/manager/product/product_combo/edit', 'New Product Feature':'/manager/product/product_feature/new', 'All Product Features':'/manager/product/product_feature/all', 'Edit Product Feature':'/manager/product/product_feature/edit', 'New Plan':'/manager/product/plan/new', 'All Plans':'/manager/product/plan/all', 'Edit Plan':'/manager/product/plan/edit', 'New Device':'/manager/product/device/new', 'All Devices':'/manager/product/device/all', 'Edit Device':'/manager/product/device/edit',
            /*** Service */
            'New Service':'/manager/service/new', 'All Services':'/manager/service/all', 'All Provisions':'/manager/service/provision/all',
            /*** Billing */
            'New Billing':'/manager/billing/bill/new', 'All Billings':'/manager/billing/bill/all', 'New Invoice':'/manager/billing/invoice/new', 'All Invoices':'/manager/billing/invoice/all',
            /*** Sales */
            'New Sales':'/manager/sales/new', 'All Sales':'/manager/sales/all', 'All Sell':'/manager/sales/sell/all', 'All Commission':'/manager/sales/commission/all',
            /*** Manager */
            'New Manager':'/manager/new', 'All Managers':'/manager/all', 'Edit Manager':'/manager/edit',
            /*** Contact Us */
            'All Messages':'/manager/contact_us/message/all', 'Edit Message':'/manager/contact_us/message/edit'
        };
    }

    /**
     * Normally use in updates
     * @param authorized_paths
     * @returns {deferred.promise|*}
     */
    function getMatchedAuthorizationLinkagesStatus(authorized_paths)
    {
        var deferred = $q.defer();
        /**
         * If authorized_paths is not null then continue
         */
        if(authorized_paths !== 'null')
        {
            authorized_paths = authorized_paths.split(',');

            /**
             * Iterate authorized_paths
             */
            for(var authorizedKey in authorized_paths)
            {
                /**
                 * Iterate all authorization linkages path
                 */
                for(var linkageKey in getAuthorizationLinkagesPath())
                {
                    if(getAuthorizationLinkagesPath()[linkageKey] == authorized_paths[authorizedKey])
                    {
                        getAuthorizationLinkagesStatus()[linkageKey] = true;
                    }
                }
            }
        }

        deferred.resolve(getAuthorizationLinkagesStatus());

        return deferred.promise;
    }

    function getFinalSelectedAuthorizedPaths(data, authorization_linkages_status, authorization_linkages_path)
    {
        var authorized_paths = '';
        var index = 1;
        var authorizedLength = 0;

        for(var linkage_status in authorization_linkages_status)
        {
            if(authorization_linkages_status[linkage_status])
            {
                authorizedLength++;
            }
        }
        for(linkage_status in authorization_linkages_status)
        {
            if(authorization_linkages_status[linkage_status])
            {
                authorized_paths += authorization_linkages_path[linkage_status];

                if(index < authorizedLength)
                {
                    authorized_paths += ',';
                }

                index++;
            }
        }
        if(authorizedLength > 0)
        {
            data.authorized_paths = authorized_paths;
        }
        else
        {
            data.authorized_paths = 'null';
        }

        return data;
    }

    return{
        getAuthorizationLinkagesStatus : getAuthorizationLinkagesStatus,
        getAuthorizationLinkagesPath : getAuthorizationLinkagesPath,
        getMatchedAuthorizationLinkagesStatus : getMatchedAuthorizationLinkagesStatus,
        getFinalSelectedAuthorizedPaths : getFinalSelectedAuthorizedPaths
    };

}]);