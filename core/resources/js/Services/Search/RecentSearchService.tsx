import { JsonObject } from '@/types';

export class RecentSearchService {

    private recentSearchesKey = 'recent_searches';

    getRecentSearches(): JsonObject | null {
        const recentSearches = localStorage.getItem(this.recentSearchesKey);

        if (recentSearches) {
            return JSON.parse(recentSearches);
        }

        return null;
    }

    addRecentSearch(search: JsonObject) {
        const recentSearches = this.getRecentSearches() || [];

        recentSearches.unshift(search);

        if (recentSearches.length > 6) {
            recentSearches.pop();
        }

        localStorage.setItem(this.recentSearchesKey, JSON.stringify(recentSearches));
    }

    removeRecentSearch(url: string) {
        const recentSearches = this.getRecentSearches() || [];

        const filteredSearches = recentSearches.filter((search: JsonObject) => search.url !== url);

        localStorage.setItem(this.recentSearchesKey, JSON.stringify(filteredSearches));
    }
}