import { useContext, useEffect, useRef, useState } from 'react';
import InfiniteScroll from "react-infinite-scroller";
import MessagingContext from '@/Contexts/MessagingContext';
import { MessageResource } from '@/types/messaging';
import Message from './Message';
import { RefOverflowScrollBox } from '../Shared/OverflowScrollBox';

export default function MessagesList() {
    const { activeMessages } = useContext(MessagingContext);
    const scrollRef = useRef<HTMLDivElement | null>(null);

    if (!activeMessages) return '';

    const loadMore = (page: number) => {
        console.log(page)
    }

    useEffect(() => {
        if (scrollRef.current) {
            scrollRef.current.scrollTop = scrollRef.current.scrollHeight;
        }

    }, [activeMessages]);

    return (
        <RefOverflowScrollBox
            ref={scrollRef}
            sx={{ px: 2 }}
        >
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
