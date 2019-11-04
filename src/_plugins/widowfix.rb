module Jekyll
  module WidowFix
    def widowfix(input)
      if "#{input}" != ""
        @words = "#{input}".split(' ')
        @lastWord = @words.last
        @allButLastWord = (@words.first @words.size - 1).join(' ')
        if @words.length > 1
          if @lastWord.include? '-'
            @output = "#{@allButLastWord} " + (@lastWord.gsub! '-', '&#8209;').to_s
          else
            @output = "#{@allButLastWord}&nbsp;#{@lastWord}"
          end
        else
          @output = "#{input}"
        end
        "#{@output}"
      end
    end
  end
end

Liquid::Template.register_filter(Jekyll::WidowFix)