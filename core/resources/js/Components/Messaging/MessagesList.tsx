import { useContext, useEffect, useRef, useState } from 'react';
import InfiniteScroll from "react-infinite-scroller";
import MessagingContext from '@/Contexts/MessagingContext';
import { MessageResource } from '@/types/messaging';
import Message from './Message';
import { RefOverflowScrollBox } from '../Shared/OverflowScrollBox';

export default function MessagesList() {
    const { activeMessages } = useContext(MessagingContext);

    if (!activeMessages) return '';

    const scrollRef = useRef<HTMLDivElement | null>(null);
    const [initialLoad, setInitialLoad] = useState(true);

    const loadMore = (page: number) => {
        console.log(page)
    }

    useEffect(() => {
        if (initialLoad && scrollRef.current) {
            scrollRef.current.scrollTop = scrollRef.current.scrollHeight;
            setInitialLoad(false);
        }

    }, [activeMessages, initialLoad]);

    return (
        <RefOverflowScrollBox ref={scrollRef}>
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
                {activeMessages.map((message : MessageResource) => (
                    <Message key={message.uuid} message={message} />
                ))}
            </InfiniteScroll>
        </RefOverflowScrollBox>
    );
}
