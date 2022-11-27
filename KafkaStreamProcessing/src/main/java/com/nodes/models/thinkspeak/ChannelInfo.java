package com.nodes.models.thinkspeak;

import com.infoworks.lab.rest.models.Message;

import java.io.IOException;
import java.util.List;

public class ChannelInfo extends Message {

    private Channel channel;
    private List<Feed> feeds;

    public ChannelInfo() { }

    public ChannelInfo(String json) {
        if (Message.isValidJson(json)){
            try {
                ChannelInfo me = Message.unmarshal(ChannelInfo.class, json);
                this.channel = me.channel;
                this.feeds = me.feeds;
            } catch (IOException e) {}
        }
    }

    public Channel getChannel() {
        return channel;
    }

    public void setChannel(Channel channel) {
        this.channel = channel;
    }

    public List<Feed> getFeeds() {
        return feeds;
    }

    public void setFeeds(List<Feed> feeds) {
        this.feeds = feeds;
    }

}
