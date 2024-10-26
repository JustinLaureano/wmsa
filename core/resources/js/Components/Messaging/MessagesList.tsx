import { useContext } from 'react';
import InfiniteScroll from "react-infinite-scroller";
import MessagingContext from '@/Contexts/MessagingContext';
import OverflowScrollBox from '../Shared/OverflowScrollBox';
import { MessageResource } from '@/types/messaging';
import Message from './Message';

export default function MessagesList() {
    const { activeMessages } = useContext(MessagingContext);

    if (!activeMessages) return '';

    const loadMore = (page: number) => {
        console.log(page)
    }

    return (
        <OverflowScrollBox>
            <InfiniteScroll
                hasMore={true}
                loadMore={loadMore}
                loader={
                    <div className="loader" key={0}>
                        Loading ...
                    </div>
                }
                isReverse={true}
                useWindow={false}
            >
                {
                    activeMessages.map((message : MessageResource) => (
                        <Message message={message} />
                    ))
                }
            </InfiniteScroll>
 
        </OverflowScrollBox>
    );
}
