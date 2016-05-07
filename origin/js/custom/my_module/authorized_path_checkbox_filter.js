/**
 * Created by Steven on 2015/7/23.
 */
angular.module('myModule.filters', [])
    .filter('authorized_linkages_filter', function() {
        return function(items, authorized_linkages) {
            var newItems = {};
            /**
             * Iterate each item
             */
            for(var item in items)
            {
                /**
                 * Iterate each authorized name
                 */
                for(var name in authorized_linkages)
                {
                    /**
                     * If item name matched authorized name then push into new items JSON obj
                     */
                    if (item.indexOf(authorized_linkages[name]) !== -1) {
                        newItems[item] = items[item];
                    }
                }
            }
            return newItems;
        };
    });