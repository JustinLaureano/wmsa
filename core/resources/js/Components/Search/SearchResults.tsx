import { JsonObject } from "@/types";
import { Stack, Typography } from "@mui/material";
import OverflowScrollBox from "../Shared/OverflowScrollBox";
import SearchResultCategory from "./SearchResultCategory";
import { useLanguage } from "@/Providers/LanguageProvider";
import MaterialRequestResultCategory from "./MaterialRequestResultCategory";

export default function SearchResults( {results}: {results: JsonObject}) {
    const { lang } = useLanguage();

    return (
        <OverflowScrollBox sx={{ maxHeight: '60vh', minHeight: '300px' }}>
            <Stack>
                {
                    results['materials'] &&
                    (
                        <SearchResultCategory
                            title={lang.materials}
                            results={results['materials']}
                        />
                    )
                }
                {
                    results['material_containers'] &&
                    (
                        <SearchResultCategory
                            title={lang.inventory}
                            results={results['material_containers']}
                        />
                    )
                }
                {
                    results['material_requests'] &&
                    (
                        <MaterialRequestResultCategory
                            title={lang.requests}
                            results={results['material_requests']}
                        />
                    )
                }
                {
                    results['irm_chemicals'] &&
                    (
                        <SearchResultCategory
                            title={lang.irm_chemicals}
                            results={results['irm_chemicals']}
                        />
                    )
                }
                {
                    results['storage_locations'] &&
                    (
                        <SearchResultCategory
                            title={lang.locations}
                            results={results['storage_locations']}
                        />
                    )
                }
                {
                    results['sort_list'] &&
                    (
                        <SearchResultCategory
                            title={lang.sort_list}
                            results={results['sort_list']}
                        />
                    )
                }
                {
                    results['machines'] &&
                    (
                        <SearchResultCategory
                            title={lang.machines}
                            results={results['machines']}
                        />
                    )
                }
            </Stack>
        </OverflowScrollBox>
    );
}