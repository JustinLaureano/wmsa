class UIState {
    private static NAMESPACE = 'wms';

    /**
     * Save a state to local storage.
     * @param key - The unique key for the state.
     * @param state - The value of the state to save.
     * @param ttl - Optional time-to-live in milliseconds.
     */
    static save<T>(key: string, state: T, ttl: number | null = null): void {
        const item: { value: T; expiry?: number } = { value: state };

        if (ttl) {
            item.expiry = Date.now() + ttl;
        }

        localStorage.setItem(`${UIState.NAMESPACE}.${key}`, JSON.stringify(item));
    }

    /**
     * Load a state from local storage.
     * @param key - The unique key for the state.
     * @param defaultState - The default state to return if no state is found or the state is expired.
     * @returns The state value or the default state.
     */
    static load<T>(key: string, defaultState: T): T {
        const savedItem = localStorage.getItem(`${UIState.NAMESPACE}.${key}`);

        if (!savedItem) {
            return defaultState;
        }

        try {
            const { value, expiry }: { value: T; expiry?: number } = JSON.parse(savedItem);

            if (expiry && Date.now() > expiry) {
                localStorage.removeItem(`${UIState.NAMESPACE}.${key}`);

                return defaultState;
            }

            return value;
        }
        catch {
            return defaultState;
        }
    }

    /**
     * Clear a specific state from local storage.
     * @param key - The unique key for the state to clear.
     */
    static clear(key: string): void {
        localStorage.removeItem(`${UIState.NAMESPACE}.${key}`);
    }

    /**
     * Clear all states within a specific namespace from local storage.
     * @param namespace - The namespace to clear.
     */
    static clearNamespace(namespace: string): void {
        Object.keys(localStorage).forEach((key) => {

            if ( key.startsWith(`${UIState.NAMESPACE}.${namespace}`) ) {
                localStorage.removeItem(key);
            }

        });
    }
}

export default UIState;